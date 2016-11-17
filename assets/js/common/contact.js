/**
 * contact
 */

$('.submit').click(function (e) {
    e.preventDefault();

    var
        fn = $("input[name*='fn']").val().replace(/<|>/g, ""),
        ln = $("input[name*='ln']").val().replace(/<|>/g, ""),
        email = $("input[name*='email']").val().replace(/<|>/g, ""),
        company = $("input[name*='company']").val().replace(/<|>/g, ""),
        phone = $("input[name*='phone']").val().replace(/<|>/g, ""),
        message = $("textarea[name*='message']").val().replace(/<|>/g, "");

    $.ajax({
        type: "POST",
        url: "/contact/",
        data: "fn=" + fn + "&ln=" + ln + "&email=" + email + "&company=" + company + "&phone=" + phone + "&message=" + message + "&g-recaptcha-response=" + grecaptcha.getResponse()
    }).done(function (response) {
        if (response == "Thank you for email!") {
            // slide down the "ok" message to the user
            $('.contact-status').text('Thanks! Your message has been sent, we will contact you soon.');
            // clear the form fields
            $('input').val('');
        } else {
            $('.contact-status').text(response);
        }
    }).fail(function () {
        $('.contact-status').text('Oops, something went wrong.');
    });
});