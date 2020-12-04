
import {useRegistration} from '@web-auth/webauthn-helper';
import {useLogin} from '@web-auth/webauthn-helper';

$(function() {
    var usernameEl = $('#username');
    var passwordEl = $('#password');



    $('#create_button').on('click', function () {
        // Create your register function.
        // By default the urls are "/register" and "/register/options"
        // but you can change those urls if needed.
        const register = useRegistration({
            actionUrl: '/api/register',
            optionsUrl: '/api/register/options'
        });


        // We can call this register function whenever we need (e.g. form submission)
        const username = $('#new_username').val();
        register({
            username: username,
            displayName: username
        })
            .then((response) => {
                console.log('Registration success');
                $('#login-help').html('<h3>User "'+username+'" created!</h3>');

            })
            .catch((error) => console.log('Registration failure'))
        ;
    });

    $('#login_button').on('click', function () {

        event.stopPropagation();
        event.stopImmediatePropagation();

        // Create your login function.
        // By default the urls are "/login" and "/login/options"
        // but you can change those urls if needed.
        const login = useLogin({
            actionUrl: '/api/login',
            optionsUrl: '/api/login/options'
        });

        const username = $('#username').val();

        // We can call this login function whenever we need (e.g. form submission)
        login({
            username: username
        })
            .then((response) => {
                console.log('Authentication success')
                location.reload();
            })
            .catch((error) => console.log('Authentication failure'))
        ;

        return false;
    });

});
