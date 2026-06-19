<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            const cityWrapper = $('#city-wrapper');

            function isTurkeyCountry() {
                let selectedCountryText = ($('#country_id option:selected').text() || '').toLowerCase().trim();
                return selectedCountryText.includes('turkey') || selectedCountryText.includes('turkiye') || selectedCountryText.includes('türkiye');
            }

            function resetCityDropdown() {
                let all_options = "<option value=''>{{__('Select City')}}</option>";
                $('.get_state_city').html(all_options);
                $('.city_info').html('');
                $('#city_id').val('');
                cityWrapper.addClass('d-none');
            }

            function loadCitiesByCountry() {
                let country = $('#country_id').val();

                if (!isTurkeyCountry()) {
                    resetCityDropdown();
                    return;
                }

                cityWrapper.removeClass('d-none');

                $.ajax({
                    method: 'post',
                    url: "{{ route('au.country.city.all') }}",
                    data: {
                        country_id: country
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select City')}}</option>";
                            let all_city = res.cities;
                            $.each(all_city, function(index, value) {
                                all_options += "<option value='" + value.id +
                                    "'>" + value.city + "</option>";
                            });
                            $('.get_state_city').html(all_options);

                            $('.city_info').html('');
                            if(all_city.length <= 0){
                                $('.city_info').html('<span class="text-danger"> {{ __('No city found for selected country!') }} <span>');
                            }
                        }
                    }
                });
            }

            //update profile
            $(document).on('submit','#edit_profile_form',function(e){
                e.preventDefault();
                let first_name = $('#first_name').val();
                let last_name = $('#last_name').val();
                let email = $('#email').val();
                let country = $('#country_id').val();
                let city = $('#city_id').val();
                let image = $('#image').val();
                let profile_background = $('#profile_background').val();

                if(first_name == '' || last_name == '' || email == '' || country == ''){
                    toastr_warning_js('Please fill all fields !');
                    return false;
                }else{
                    $.ajax({
                        url: "{{ route('user.profile.edit') }}",
                        type: 'post',
                        data: {
                            first_name: first_name,
                            last_name:last_name,
                            email:email,
                            country:country,
                            city:city,
                            image:image,
                            profile_background:profile_background,
                        },
                        success: function(res){
                            if(res.status == 'ok'){
                                window.location.reload();
                                toastr_success_js("{{ __('Profile Info Successfully Updated') }}");
                            }
                        },
                        error: function (err) {
                            let error = err.responseJSON;
                            $('.error_msg_container').html('');
                            $.each(error.errors, function (index, value) {
                                $('.error_msg_container').append('<p class="text-danger">'+value+'<p>');
                            });
                        }
                    });
                }
            });


            // change country and get cities for Turkey only
            $(document).on('change','#country_id', function() {
                loadCitiesByCountry();
            });

            loadCitiesByCountry();

        });
    }(jQuery));

    // toastr warning
    function toastr_warning_js(msg){
        Command: toastr["warning"](msg, "Warning !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
    //toastr success
    function toastr_success_js(msg){
        Command: toastr["success"](msg, "Success !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
</script>
