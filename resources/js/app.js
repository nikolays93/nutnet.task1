/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const $recordForm = $(document.record);
const $errors = $recordForm.find('.errors');

if ($recordForm.length && $recordForm.hasClass('ajax')) {
	$recordForm.on('submit', function(event) {
		event.preventDefault();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $recordForm.find('[name="_token"]').val(),
			}
		});

		$.ajax({
			type: $recordForm.attr('method'), // $recordForm.find('[name="_method"]').val(),
			url: $recordForm.attr('action'),
			data: $recordForm.serialize(),

			success: function(data) {
				// Reset errors.
				$errors.html('');
				$recordForm.find('.is-invalid').removeClass('is-invalid');

				// Redirect to list.
				document.location.href = $recordForm.find('[name="_list"]').val();
			},

			error: function (err) {
				if (err.status == 422) {
					// Join errors, del: <br />\n
					let errorsHTML = Object.keys(err.responseJSON.errors)
						.map(key => err.responseJSON.errors[key])
						.join("<br />\n");

					// Show errors in form.
					$errors.html('<div class="alert alert-danger">' + errorsHTML + '</div>');

					// display errors on each form field.
					$.each(err.responseJSON.errors, function (fieldName, error) {
						$recordForm.find('[name="'+fieldName+'"]').addClass('is-invalid');
					});
				}
			},
		});
	});
}