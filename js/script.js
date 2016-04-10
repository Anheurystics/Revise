$(document).ready(function() {
	var alertbox = $("#alert");

	alertbox.hide();

	$("#loginButton").click(login);
	$("#loginForm").submit(login);

	function login(e) {
		e.preventDefault();

		var userField = $("#loginUser");
		var passField = $("#loginPassword");

		userField.css("background-color", (userField.val().length == 0) ? "#FF5555" : "#FFFFFF");
		passField.css("background-color", (passField.val().length == 0) ? "#FF5555" : "#FFFFFF");

		if (userField.val().length == 0 || passField.val().length == 0) {
			return;
		}
		
		$.ajax({
			type: "POST",
			url: "login.php",
			data: $("#loginForm").serialize(),
			success: function(data) {
				var header = undefined;
				var message = undefined;
				var type = undefined;
				
				if (data == "success") {
					window.location.href = "dashboard";
				} else if (data == "incorrect") {
					alertbox.show();
					$("#alertHeader").text("Error!");
					$("#alertMessage").text("Wrong username or password");
					alertbox.removeClass();
					alertbox.addClass("alert alert-danger fade in");
				}

				if (message != undefined) {
					alertbox.show();
					$("#alertHeader").text(header);
					$("#alertMessage").text(message);
					alertbox.removeClass();
					alertbox.addClass("alert alert-" + type + " fade in");
				}
			}
		});
	}

	$("#registerButton").click(register);
	$("#registerForm").submit(register);

	function register(e) {
		e.preventDefault();
		
		var userField = $("#registerUser");
		var emailField = $("#registerEmail");
		var passField = $("#registerPass");

		userField.css("background-color", (userField.val().length == 0) ? "#FF5555" : "#FFFFFF");
		emailField.css("background-color", (emailField.val().length == 0) ? "#FF5555" : "#FFFFFF");
		passField.css("background-color", (passField.val().length == 0) ? "#FF5555" : "#FFFFFF");

		if (userField.val().length == 0 || emailField.val().length == 0 || passField.val().length == 0) {
			return;
		}

		$.ajax({
			type: "POST",
			url: "register.php",
			data: $("#registerForm").serialize(),
			success: function(data) {
				var header = undefined;
				var message = undefined;
				var type = undefined;

				if (data == "success") {
					header = "Success!";
					message = "Registration successful. You may now log in.";
					type = "success";

					$("#registerUser").val("");
					$("#registerEmail").val("");
					$("#registerPass").val("");
				} else if (data == "taken") {
					header = "Error!";
					message = "There already exists an account with that username/email!";
					type = "danger";
				}

				if (message != undefined) {
					alertbox.show();
					$("#alertHeader").text(header);
					$("#alertMessage").text(message);
					alertbox.removeClass();
					alertbox.addClass("alert alert-" + type + " fade in");
				}
			}
		});
	}

});