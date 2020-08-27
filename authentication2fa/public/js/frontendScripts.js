satisfyOpenPopup = async() => {
    let data = {
        action: 'mtauth_is_user_logged_in',
        nonce: MT_AUTH_JS_PARAMS.nonce
    };
    return await jQuery.post(MT_AUTH_JS_PARAMS.ajaxUrl, data);
};

popupMainDiv = () => {
    DIV = document.createElement("div");
    DIV.className = 'modal fade';
    DIV.id = 'mt-auth-popup';
    DIV.role = 'dialog';

    let contentDiv = `
        <div class="modal-dialog cascading-modal" role="document">
             <!--Content-->
             <div class="modal-content" id="mt-auth-popup-content">     
             </div>
        </div>
    `;

    DIV.innerHTML = contentDiv;
    document.body.appendChild(DIV);
};

popupAddFormContent = () => {
    let html = `
        <div class="modal-c-tabs">
            <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab">
                        <i class="icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </i>
                        ${MT_AUTH_JS_PARAMS.translations.login}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel8" role="tab">
                        <i class="icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                              <path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
                            </svg>
                        </i>
                        ${MT_AUTH_JS_PARAMS.translations.registration}
                    </a>
                </li>
            </ul>
            <!-- Tab panels -->
            <div class="tab-content">
                <!--Login-->
                <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
                    <!--Body-->
                    <div class="modal-body mb-1">
                        <div class="md-form form-sm mb-5">
                            <i class="icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </i>
                            <input type="text" id="mt-auth-login-username" class="form-control form-control-sm validate" name="mt-auth-login-username" placeholder="${MT_AUTH_JS_PARAMS.translations.username}">
                        </div>

                        <div class="md-form form-sm mb-4">
                            <i class="icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/>
                                    <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                </svg>
                            </i>
                            <input type="password" id="mt-auth-login-password" class="form-control form-control-sm validate" name="mt-auth-login-password" placeholder="${MT_AUTH_JS_PARAMS.translations.password}">
                        </div>

                        <div class="text-center mt-2">
                            <button class="btn btn-info" id="mt-auth-login-submit">
                                ${MT_AUTH_JS_PARAMS.translations.login}
                            </button>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <div class="">
                            <input type="checkbox" id="mt-auth-login-remember" class="form-control form-control-sm validate" name="mt-auth-login-remember">
                            <label data-error="wrong" data-success="right" for="mt-auth-login-remember">${MT_AUTH_JS_PARAMS.translations.rememberme}</label>
                        </div>
                      
                        <div class="">
                        <a href="#" class="blue-text" id="mt-auth-forgot-link">Forgot Password?</a>
                        </div>
                    </div>
                </div>
                
                <!--Registration-->
                <div class="tab-pane fade" id="panel8" role="tabpanel">    
                    <!--Body-->
                    <div class="modal-body">
                        <div class="md-form form-sm mb-5">
                            <i class="icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                </svg>
                            </i>                            
                            <input type="email" id="mt-auth-registration-email" class="form-control form-control-sm validate" name="mt-auth-registration-email" placeholder="${MT_AUTH_JS_PARAMS.translations.email}">
                        </div>
                        
                        <div class="md-form form-sm mb-5">
                            <i class="icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </i>                            
                            <input type="text" id="mt-auth-registration-username" class="form-control form-control-sm validate" name="mt-auth-registration-username" placeholder="${MT_AUTH_JS_PARAMS.translations.username}">
                        </div>
                        
                         <div class="md-form form-sm mb-5">
                            <i class="icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/>
                                    <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                </svg>
                            </i>                            
                             <input type="password" id="mt-auth-registration-password" class="form-control form-control-sm validate" name="mt-auth-registration-password" placeholder="${MT_AUTH_JS_PARAMS.translations.password}">
                         </div>                

                         <div class="text-center form-sm mt-2">
                            <button class="btn btn-info" id="mt-auth-registration-submit">
                                ${MT_AUTH_JS_PARAMS.translations.registration}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    return html;
};

popupAddForgotFormEmailContent = () => {
    let html = `    
     <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
        <div id="mt-forgot-back">
            <i class="icon">
   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
</svg>
            </i>
        </div>
        <!--Body-->
        <div class="modal-body mb-1">
            <h5>${MT_AUTH_JS_PARAMS.translations.forgotPassword}</h5>
        
            <div class="md-form form-sm mb-5">
                <i class="icon">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                    </svg>
                </i>
                <input type="email" id="mt-auth-forgot-email" class="form-control form-control-sm validate" name="mt-auth-forgot-email" placeholder="${MT_AUTH_JS_PARAMS.translations.email}">
            </div>

            <div class="text-center mt-2">
                <button class="btn btn-info" id="mt-auth-forgot-email-submit">
                    ${MT_AUTH_JS_PARAMS.translations.confirm}
                </button>
            </div>
        </div>
    </div>
    `;

    return html;
};

popupAddForgotFormPasswordContent = () => {
    let html = `    
     <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
        <!--Body-->
        <div class="modal-body mb-1">
            <h5>${MT_AUTH_JS_PARAMS.translations.resetPassword}</h5>
        
            <div class="md-form form-sm mb-5">
                <i class="icon">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/>
                        <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                    </svg>
                </i>
                <input type="password" id="mt-auth-reset-password" class="form-control form-control-sm validate" name="mt-auth-reset-password" placeholder="${MT_AUTH_JS_PARAMS.translations.newPassword}">
            </div>

            <div class="text-center mt-2">
                <button class="btn btn-info" id="mt-auth-reset-password-submit">
                    ${MT_AUTH_JS_PARAMS.translations.resetPassword}
                </button>
            </div>
        </div>
    </div>
    `;

    return html;
};

popupAddTwoFaContent = () => {
    let html = `    
     <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
        <!--Body-->
        <div class="modal-body mb-1">
            <h5>${MT_AUTH_JS_PARAMS.translations.confirm}</h5>
        
            <div class="md-form form-sm mb-5">
                <i class="icon">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                </i>
                <input type="number" id="mt-auth-twofa-code" class="form-control form-control-sm validate" name="mt-auth-twofa-code" placeholder="${MT_AUTH_JS_PARAMS.translations.twoFaCode}">
            </div>

            <div class="text-center mt-2">
                <button class="btn btn-info" id="mt-auth-twofa-confirm">
                    ${MT_AUTH_JS_PARAMS.translations.confirm}
                </button>
            </div>
        </div>
    </div>
    `;

    return html;
};

login = () => {
    let username = jQuery('#mt-auth-login-username').val();
    if (!username.length) {
        jQuery('#mt-auth-login-username').css("border-bottom", "1px solid #f44336");
        return null;
    }
    let password = jQuery('#mt-auth-login-password').val();
    if (!password.length) {
        jQuery('#mt-auth-login-password').css("border-bottom", "1px solid #f44336");
        return null;
    }
    let remember = jQuery('#mt-auth-login-remember').is(":checked");
    jQuery('#mt-auth-login-submit').prop('disabled', true);

    let data = {
        action: 'mtauth_user_login',
        nonce: MT_AUTH_JS_PARAMS.nonce,
        submittedData : {
            username: username,
            password: password,
            remember: remember
        }
    };

    jQuery.post(MT_AUTH_JS_PARAMS.ajaxUrl, data, function(response) {
        let result = JSON.parse(response);
        if (result.status == 401) {
            jQuery('#mt-auth-popup-content').html(popupAddTwoFaContent());
            data.submittedData['userId'] = result.userId;
            jQuery('#mt-auth-twofa-confirm').click(function(){
                confirmLogin(data.submittedData);
            });
        }
        else {
            showMessagesDialog(result);
            setTimeout(function() {
                location.reload();
            },300);
        }
    });
};

confirmLogin = (submittedData) => {
    let code = jQuery('#mt-auth-twofa-code').val();
    if (!code.length) {
        jQuery('#mt-auth-twofa-code').css("border-bottom", "1px solid #f44336");
        return null;
    }
    submittedData['code'] = code;
    let data = {
        action: 'mtauth_user_confirm_login',
        nonce: MT_AUTH_JS_PARAMS.nonce,
        submittedData : submittedData
    };
    jQuery('#mt-auth-twofa-confirm').prop('disabled', true);
    jQuery.post(MT_AUTH_JS_PARAMS.ajaxUrl, data, function(response) {console.log(response);
        let result = JSON.parse(response);
        showMessagesDialog(result);
        setTimeout(function() {
            location.reload();
        },300);
    });

};

registration = () => {
    let email = jQuery('#mt-auth-registration-email').val();
    if (!email.length) {
        jQuery('#mt-auth-registration-email').css("border-bottom", "1px solid #f44336");
        return null;
    }
    let username = jQuery('#mt-auth-registration-username').val();
    if (!username.length) {
        jQuery('#mt-auth-registration-username').css("border-bottom", "1px solid #f44336");
        return null;
    }
    let password = jQuery('#mt-auth-registration-password').val();
    if (!password.length) {
        jQuery('#mt-auth-registration-password').css("border-bottom", "1px solid #f44336");
        return null;
    }

    let data = {
        action: 'mtauth_user_registration',
        nonce: MT_AUTH_JS_PARAMS.nonce,
        submittedData : {
            username: username,
            email: email,
            password: password,
        }
    };
    jQuery('#mt-auth-registration-submit').prop('disabled', true);
    jQuery.post(MT_AUTH_JS_PARAMS.ajaxUrl, data, function(response) {
        let result = JSON.parse(response);
        showMessagesDialog(result);
        setTimeout(function() {
            location.reload();
        },300);
    });
};

forgotPassword = () => {
    jQuery('#mt-auth-popup-content').html(popupAddForgotFormEmailContent());
    jQuery('#mt-auth-forgot-email-submit').click(function() {
        let email = jQuery('#mt-auth-forgot-email').val();
        if (!email.length) {
            return null;
        }
        let data = {
            action: 'mtauth_user_forgot_password',
            nonce: MT_AUTH_JS_PARAMS.nonce,
            submittedData: {
                email: email
            }
        };
        jQuery.post(MT_AUTH_JS_PARAMS.ajaxUrl, data, function(response) {
            let result = JSON.parse(response);
            showMessagesDialog(result);
            setTimeout(function() {
                location.reload();
            },300);
        });
    });
    jQuery('#mt-forgot-back').click(function () {
        showMainForm();
        initListners();
    });
};

resetPassword = () => {
    let newPass = jQuery('#mt-auth-reset-password').val();
    if (!newPass.length) {
        jQuery('#mt-auth-reset-password').css("border-bottom", "1px solid #f44336");
        return null;
    }
    let data = {
        action: 'mtauth_user_reset_password',
        nonce: MT_AUTH_JS_PARAMS.nonce,
        submittedData : {
            newPass: newPass,
            userKey: urlParams.get('mtAuthKey'),
            username: urlParams.get('user')
        }
    };
    jQuery('#mt-auth-reset-password-submit').prop('disabled', true);
    jQuery.post(MT_AUTH_JS_PARAMS.ajaxUrl, data, function(response) {
        let result = JSON.parse(response);
        console.log(result);
        showMessagesDialog(result);
        let url = location.protocol + '//' + location.host + location.pathname;
        setTimeout(function() {
            location.href = url;
        },300);
    });

};

showMessagesDialog = (response) => {
    if (response.status == 200) {
        showMessageInDialog('success', response.message);
    }
    else if (response.status == 400) {
        showMessageInDialog('danger', response.message);
    }
};

showMessageInDialog = (messageType, message) => {
    let html = `
        <div class="alert alert-${messageType}" role="alert">
            ${message}
        </div>
    `;

    jQuery('#mt-auth-popup-content').html(html);
};

initListners = () => {
    jQuery('#mt-auth-login-submit').click(function(){
        login();
    });
    jQuery('#mt-auth-registration-submit').click(function(){
        registration();
    });
    jQuery('#mt-auth-forgot-link').click(function(){
        forgotPassword();
    });
    jQuery('#mt-auth-reset-password-submit').click(function() {
        resetPassword();
    });
};

showMainForm = () => {
    jQuery('#mt-auth-popup-content').html(popupAddFormContent());
};

init = async () => {
    let userIsLoggedIn = await satisfyOpenPopup();
    if (userIsLoggedIn) {
        return null;
    }
    popupMainDiv();
    jQuery('#mt-auth-popup').modal('show');

    urlParams = new URLSearchParams(window.location.search);
    let action = urlParams.get('action');
    if (action === 'respass') {
        jQuery('#mt-auth-popup-content').html(popupAddForgotFormPasswordContent());
    }
    else {
        showMainForm();
    }

    initListners();
};

jQuery(document).ready(function() {
    init();
});

