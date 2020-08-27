<?php
$userId = get_current_user_id();
$twoFaOption = get_user_meta($userId, MT_AUTH_PLUGIN_2FA_OPTION, true);
$twoFaOption =  empty($twoFaOption) ? '': 'checked' ;
?>

<h2><?php _e('Authentication Settings', MT_AUTH_PLUGIN_TEXT_DOMAIN); ?></h2>
<table>
    <tbody>
        <tr>
            <th>
                <label for=""></label><?php _e('Two Factor Authentication', MT_AUTH_PLUGIN_TEXT_DOMAIN); ?></label>
            </th>
            <td aria-live="assertive">
                <input type="checkbox" name="mt-auth-2fa-option" id="mt-auth-2fa-option" <?php echo esc_html($twoFaOption); ?>>
            </td>
        </tr>
    </tbody>
</table>

