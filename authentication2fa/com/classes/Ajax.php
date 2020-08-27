<?php
namespace mtauth;

class Ajax
{
    public function __construct() {
        $this->actions();
    }


    public function getPostData() {
        return $this->postData;
    }

    public function actions() {
        /* check user state*/
        add_action('wp_ajax_mtauth_is_user_logged_in', array($this, 'checkUserState'));
        add_action('wp_ajax_nopriv_mtauth_is_user_logged_in', array($this, 'checkUserState'));

        /* user login*/
        add_action('wp_ajax_mtauth_user_login', array($this, 'userLogin'));
        add_action('wp_ajax_nopriv_mtauth_user_login', array($this, 'userLogin'));

        /* user login confirmation*/
        add_action('wp_ajax_mtauth_user_confirm_login', array($this, 'confirmLogin'));
        add_action('wp_ajax_nopriv_mtauth_user_confirm_login', array($this, 'confirmLogin'));

        /* user registration*/
        add_action('wp_ajax_mtauth_user_registration', array($this, 'userRegistration'));
        add_action('wp_ajax_nopriv_mtauth_user_registration', array($this, 'userRegistration'));

        /* user forgot password*/
        add_action('wp_ajax_mtauth_user_forgot_password', array($this, 'forgotPassword'));
        add_action('wp_ajax_nopriv_mtauth_user_forgot_password', array($this, 'forgotPassword'));

        /* user reset password*/
        add_action('wp_ajax_mtauth_user_reset_password', array($this, 'resetPassword'));
        add_action('wp_ajax_nopriv_mtauth_user_reset_password', array($this, 'resetPassword'));

        /* Autosave*/
        add_action('wp_ajax_mtauth_autosave', array($this, 'autosaveAction'));
    }

    public function autosaveAction() {
        check_ajax_referer(MT_AUTH_AJAX_NONCE, 'nonce');

        $userId = get_current_user_id();
        update_user_meta($userId, MT_AUTH_PLUGIN_2FA_OPTION, $_POST['value']);

        wp_die();
    }

    public function checkUserState() {
        check_ajax_referer(MT_AUTH_AJAX_NONCE, 'nonce');
        $userState = is_user_logged_in();

        echo $userState;
        wp_die();
    }

    public function userLogin() {
        check_ajax_referer(MT_AUTH_AJAX_NONCE, 'nonce');
        $submittedData = $_POST['submittedData'];
        $result = array(
            'status' => 200,
            'message' => __('You successfully logged', MT_AUTH_PLUGIN_TEXT_DOMAIN)
        );

        $username = sanitize_text_field($submittedData['username']);
        $password = sanitize_text_field($submittedData['password']);
        $remember = $submittedData['remember'];

        $user = wp_authenticate($username, $password);

        if (is_wp_error($user)) {
            $result = array(
                'status' => 400,
                'message' => __('Invalid username or password', MT_AUTH_PLUGIN_TEXT_DOMAIN)
            );

            echo json_encode($result);
            wp_die();
        }
        else {
            $userId = $user->ID;
            $twoFAOption = @get_user_meta($userId, MT_AUTH_PLUGIN_2FA_OPTION, true);
            if (!empty($twoFAOption)) {
                $userEmail = $user->user_email;
                MtAuthHelper::runTwoFaOption($userId, $userEmail);
                $result = array(
                    'status' => 401,
                    'message' => __('Enter the verification code.', MT_AUTH_PLUGIN_TEXT_DOMAIN)
                );

                $result['userId'] = $userId;
            }
            else {
                $user = MtAuthHelper::customLoginFunction($username, $password, $remember);
                if (is_wp_error($user)) {
                    $result = array(
                        'status' => 400,
                        'message' => __('Invalid username or password', MT_AUTH_PLUGIN_TEXT_DOMAIN)
                    );
                }
            }
        }
        echo json_encode($result);
        wp_die();
    }

    public function userRegistration() {
        check_ajax_referer(MT_AUTH_AJAX_NONCE, 'nonce');
        $submittedData = $_POST['submittedData'];
        $result = array(
            'status' => 200,
            'message' => __('You successfully logged', MT_AUTH_PLUGIN_TEXT_DOMAIN)
        );

        $username = sanitize_text_field($submittedData['username']);
        $email = sanitize_text_field($submittedData['email']);
        $password = sanitize_text_field($submittedData['password']);

        $user = wp_create_user($username, $password, $email);
        if (is_wp_error($user)) {
            $result = array(
                'status' => 400,
                'message' => __('User Already exists', MT_AUTH_PLUGIN_TEXT_DOMAIN)
            );
        }
        else {
            $user = MtAuthHelper::customLoginFunction($username, $password);
        }

        echo json_encode($result);
        wp_die();
    }

    public function confirmLogin() {
        check_ajax_referer(MT_AUTH_AJAX_NONCE, 'nonce');
        $submittedData = $_POST['submittedData'];
        $result = array(
            'status' => 200,
            'message' => __('You successfully logged', MT_AUTH_PLUGIN_TEXT_DOMAIN)
        );

        $code = $submittedData['code'];
        $userId = $submittedData['userId'];
        $username = sanitize_text_field($submittedData['username']);
        $password = sanitize_text_field($submittedData['password']);
        $remember = $submittedData['remember'];

        $userTimestamp = get_user_meta($userId, MT_AUTH_PLUGIN_TOKEN_TIMESTAMP, true);
        $thisTime = time();

        if ($userTimestamp + MINUTE_IN_SECONDS * 10 > $thisTime)  {
            $userToken = get_user_meta($userId, MT_AUTH_PLUGIN_TOKEN, true);

            if ($userToken == wp_hash($code)) {
                $user = MtAuthHelper::customLoginFunction($username, $password, $remember);
            }
            else {
                $result = array(
                    'status' => 400,
                    'message' => __('Your token has expired', MT_AUTH_PLUGIN_TEXT_DOMAIN)
                );
            }
        }
        delete_user_meta($userId, MT_AUTH_PLUGIN_TOKEN);

        echo json_encode($result);
        wp_die();
    }

    public function forgotPassword() {
        check_ajax_referer(MT_AUTH_AJAX_NONCE, 'nonce');
        $submittedData = $_POST['submittedData'];

        $result = array(
            'status' => 200,
            'message' => __('Please check your mailbox', MT_AUTH_PLUGIN_TEXT_DOMAIN)
        );

        $email = sanitize_text_field($submittedData['email']);
        $user = get_user_by('email', $email);
        if (!$user) {
            $result = array(
                'status' => 400,
                'message' => __('Incorrect email address', MT_AUTH_PLUGIN_TEXT_DOMAIN)
            );

            echo json_encode($result);
            wp_die();
        }

        $userId = $user->ID;
        $username = $user->user_login;
        $url = get_home_url();
        $token =  MtAuthHelper::generateToken();
        $key = wp_hash($token);

        update_user_meta($userId, MT_AUTH_PLUGIN_LINK_KEY, wp_hash($key));

        $url .= "?action=respass";
        $url .= "&mtAuthKey=$key";
        $url .= "&user=$username";

        $blogname = get_option('blogname');
        $subject = "Reset Password";
        $headers  = MtAuthHelper::getEmailHeaders();
        $message = __('To reset your password, visit the following address', MT_AUTH_PLUGIN_TEXT_DOMAIN);
        $message .= '<a href="'.$url.'">Reset Password</a>';

        $emailStatus = wp_mail($email, $subject, $message, $headers);
        if (is_wp_error($emailStatus)) {
            $result = array(
                'status' => 400,
                'message' => __('Incorrect email address', MT_AUTH_PLUGIN_TEXT_DOMAIN)
            );
        }

        echo json_encode($result);
        wp_die();
    }

    public function resetPassword() {
        check_ajax_referer(MT_AUTH_AJAX_NONCE, 'nonce');
        $submittedData = $_POST['submittedData'];
        $result = array(
            'status' => 200,
            'message' => __('Your password successfully changed.', MT_AUTH_PLUGIN_TEXT_DOMAIN)
        );

        $username = $submittedData['username'];
        $urlKey = $submittedData['userKey'];
        $newPass = sanitize_text_field($submittedData['newPass']);

        $user = get_user_by('login', $username);
        
        if (!$user) {
            $result = array(
                'status' => 400,
                'message' => __('User not exists', MT_AUTH_PLUGIN_TEXT_DOMAIN)
            );

            echo json_encode($result);
            wp_die();
        }
        $userId = $user->ID;
        $userKey = get_user_meta($userId, MT_AUTH_PLUGIN_LINK_KEY, true);

        if ($userKey == wp_hash($urlKey)) {
            $change = wp_set_password($newPass, $userId);
            if (is_wp_error($change)) {
                $result = array(
                    'status' => 400,
                    'message' => __('Please try again.', MT_AUTH_PLUGIN_TEXT_DOMAIN)
                );
            }
        }

        echo json_encode($result);
        wp_die();
    }
}