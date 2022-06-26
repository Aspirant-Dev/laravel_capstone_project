
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
  {{-- <div class="modal fade"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content" style="border-radius: 0px!important;">
        <div class="modal-header text-center">
          <h5 class="modal-title w-100" id="exampleModalLabel" style="color: #ee4d2d">Add New Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
                <form method="POST" action="{{ route('delivery-address') }}" class="needs-validation" novalidate>
                    @csrf
                    <!-- First Name && Last Name -->
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                            <label for="fname" class="col-md-6 col-form-label">{{ __('First Name') }}</label>
                            <input id="fname"  required placeholder="Ex. Juan" type="text"  class="form-control @error('fname') is-invalid @enderror"
                            name="fname" value="{{ old('fname') }}"  autocomplete="off">
                            <div class="invalid-feedback text-start fw-bold">This field is required.</div>

                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ ('First name is required') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lname" class="col-md-6 col-form-label">{{ __('Last Name') }}</label>
                            <input id="lname" required placeholder="Ex. Dela Cruz" type="text" class="form-control @error('lname') is-invalid @enderror"
                             name="lname" value="{{ old('lname') }}"  autocomplete="off">
                             <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ ('Last name is required') }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- Contact -->
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label">{{ __('Contact No.') }}<small style="font-style: italic"> (09xx-xxx-xxxx)</small></label>
                            <input required placeholder="Enter you contact no." type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" title="Please follow the format."
                                class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}"  autocomplete="off">
                            <div class="invalid-feedback text-start fw-bold">This field is required. Please follow the format.</div>

                            @error('phone_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ ('Contact number is required') }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    <br>
                    <!-- City -->
                    <!-- Barangay -->
                    <!-- Postal Code -->
                    <div class="form-group row">
                        <p style="font-style:italic; margin-top: 2px; margin-bottom: -2px"><small><b>Note: </b>Please select first the city to choose barangay and the postal code will auto filled.</small></p>
                        <div class="col-md-4">
                            <label for="city" class=" col-form-label">{{ __('City') }}</label>
                            <select id="options" required class="custom-select form-control @error('city') is-invalid @enderror"  name="city">
                                <option value="" disabled hidden selected>Please select...</option>
                                <option value="Bocaue">Bocaue</option>
                                <option value="Marilao">Marilao</option>
                                <option value="Meycauayan">Meycauayan</option>
                            </select>

                            <div class="invalid-feedback text-start fw-bold">Please select a city from the list.</div>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ ('Please select a city in the list') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="barangay" class=" col-form-label">{{ __('Barangay') }}</label>
                            <select id="choices" required class="custom-select form-control @error('barangay') is-invalid @enderror" name="barangay">
                                <option value="" disabled hidden selected>Please select...</option>
                            </select>
                            @error('barangay')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ ('Please select a barangay in the list') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="postal-code" class=" col-form-label">{{ __('Postal Code') }}</label>
                            <select id="pc" required class=" form-control @error('postal_code') is-invalid @enderror" name="postal_code">
                                <option value="" disabled hidden selected></option>
                            </select>
                            @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ ('Postal code is required') }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- Detailed Address -->
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="detailed-address" class="col-form-label">{{ __('Detailed Adress') }}</label>
                            <p style="margin-top: -8px; margin-bottom: 10px"><small>Unit number, house number, building, street name</small></p>
                            <input id="detailed-address" required placeholder="Set Detailed Address" type="text" class="form-control @error('detailed_address') is-invalid @enderror" name="detailed_address" value="{{ old('detailed_address') }}"  autocomplete="off" >

                            <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                            @error('detailed_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ ('Please set your detailed address') }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()
</script>
