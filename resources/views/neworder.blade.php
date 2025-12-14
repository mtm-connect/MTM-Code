<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ __('New Order') }}
        </h2>
    </x-slot>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('order.store') }}">
        @csrf
   

<div class="w-full  px-6 pt-12 pb-4  overflow-hidden sm:rounded-lg">

    <!-- Grid layout for two columns -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <!-- Left Column -->
        <div class="">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Client Name')" />
                <x-text-input id="name" class="block mt-3 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input 
                    id="phone" 
                    class="block mt-3 w-full" 
                    type="tel" 
                    name="phone_number" 
                    :value="old('phone')" 
                    required 
                    autocomplete="tel" 
                    pattern="(?:\+?\d{1,3})?[-.\s]?(\(?\d{1,4}\)?[-.\s]?)?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,4}"  
                />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-3 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Occasion -->
            <div class="mt-4">
                <x-input-label for="occasion" :value="__('Occasion')" />
                <x-text-input id="occasion" class="block mt-3 w-full" type="text" name="occasion" :value="old('occasion')" required autocomplete="occasion" />
                <x-input-error :messages="$errors->get('occasion')" class="mt-2" />
            </div>

                 <!-- Date Required -->
                 <div class="mt-4">
                <x-input-label for="date_required" :value="__('Date Required')" />
                <x-text-input 
                    id="date_required" 
                    class="block mt-3 w-full" 
                    type="date" 
                    name="date_required" 
                    :value="old('date_required')" 
                    required 
                    autocomplete="date_required" 
                />
                <x-input-error :messages="$errors->get('date_required')" class="mt-2" />
            </div>
            
        </div>

        

        <!-- Right Column -->
        <div class="">
            
        <!-- Country -->
<div class="">
    <x-input-label for="country" :value="__('Country')" />
    <select id="country" name="country" class="block mt-3 w-full p-4 border-gray-300 bg-gray-300 bg-opacity-10 focus:font-bold focus:bg-emerald-950 focus:bg-opacity-10 focus:border-emerald-950 rounded-lg focus:ring-emerald-950" required>
        <option value="" disabled selected>Select a country</option>
        <option value="AF">Afghanistan</option>
        <option value="AL">Albania</option>
        <option value="DZ">Algeria</option>
        <option value="AS">American Samoa</option>
        <option value="AD">Andorra</option>
        <option value="AO">Angola</option>
        <option value="AI">Anguilla</option>
        <option value="AG">Antigua and Barbuda</option>
        <option value="AR">Argentina</option>
        <option value="AM">Armenia</option>
        <option value="AW">Aruba</option>
        <option value="AU">Australia</option>
        <option value="AT">Austria</option>
        <option value="AZ">Azerbaijan</option>
        <option value="BS">Bahamas</option>
        <option value="BH">Bahrain</option>
        <option value="BD">Bangladesh</option>
        <option value="BB">Barbados</option>
        <option value="BY">Belarus</option>
        <option value="BE">Belgium</option>
        <option value="BZ">Belize</option>
        <option value="BJ">Benin</option>
        <option value="BM">Bermuda</option>
        <option value="BT">Bhutan</option>
        <option value="BO">Bolivia</option>
        <option value="BA">Bosnia and Herzegovina</option>
        <option value="BW">Botswana</option>
        <option value="BR">Brazil</option>
        <option value="IO">British Indian Ocean Territory</option>
        <option value="BN">Brunei Darussalam</option>
        <option value="BG">Bulgaria</option>
        <option value="BF">Burkina Faso</option>
        <option value="BI">Burundi</option>
        <option value="KH">Cambodia</option>
        <option value="CM">Cameroon</option>
        <option value="CA">Canada</option>
        <option value="CV">Cape Verde</option>
        <option value="KY">Cayman Islands</option>
        <option value="CF">Central African Republic</option>
        <option value="TD">Chad</option>
        <option value="CL">Chile</option>
        <option value="CN">China</option>
        <option value="CO">Colombia</option>
        <option value="KM">Comoros</option>
        <option value="CG">Congo</option>
        <option value="CD">Congo, Democratic Republic of the</option>
        <option value="CK">Cook Islands</option>
        <option value="CR">Costa Rica</option>
        <option value="HR">Croatia</option>
        <option value="CU">Cuba</option>
        <option value="CY">Cyprus</option>
        <option value="CZ">Czech Republic</option>
        <option value="CI">Côte d'Ivoire</option>
        <option value="DK">Denmark</option>
        <option value="DJ">Djibouti</option>
        <option value="DM">Dominica</option>
        <option value="DO">Dominican Republic</option>
        <option value="EC">Ecuador</option>
        <option value="EG">Egypt</option>
        <option value="SV">El Salvador</option>
        <option value="GQ">Equatorial Guinea</option>
        <option value="ER">Eritrea</option>
        <option value="EE">Estonia</option>
        <option value="ET">Ethiopia</option>
        <option value="FO">Faroe Islands</option>
        <option value="FJ">Fiji</option>
        <option value="FI">Finland</option>
        <option value="FR">France</option>
        <option value="GA">Gabon</option>
        <option value="GM">Gambia</option>
        <option value="GE">Georgia</option>
        <option value="DE">Germany</option>
        <option value="GH">Ghana</option>
        <option value="GI">Gibraltar</option>
        <option value="GR">Greece</option>
        <option value="GL">Greenland</option>
        <option value="GD">Grenada</option>
        <option value="GT">Guatemala</option>
        <option value="GG">Guernsey</option>
        <option value="GN">Guinea</option>
        <option value="GW">Guinea-Bissau</option>
        <option value="GY">Guyana</option>
        <option value="HT">Haiti</option>
        <option value="HN">Honduras</option>
        <option value="HK">Hong Kong</option>
        <option value="HU">Hungary</option>
        <option value="IS">Iceland</option>
        <option value="IN">India</option>
        <option value="ID">Indonesia</option>
        <option value="IR">Iran</option>
        <option value="IQ">Iraq</option>
        <option value="IE">Ireland</option>
        <option value="IL">Israel</option>
        <option value="IT">Italy</option>
        <option value="JM">Jamaica</option>
        <option value="JP">Japan</option>
        <option value="JE">Jersey</option>
        <option value="JO">Jordan</option>
        <option value="KZ">Kazakhstan</option>
        <option value="KE">Kenya</option>
        <option value="KI">Kiribati</option>
        <option value="KW">Kuwait</option>
        <option value="KG">Kyrgyzstan</option>
        <option value="LA">Laos</option>
        <option value="LV">Latvia</option>
        <option value="LB">Lebanon</option>
        <option value="LS">Lesotho</option>
        <option value="LR">Liberia</option>
        <option value="LY">Libya</option>
        <option value="LI">Liechtenstein</option>
        <option value="LT">Lithuania</option>
        <option value="LU">Luxembourg</option>
        <option value="MO">Macau</option>
        <option value="MK">Macedonia</option>
        <option value="MG">Madagascar</option>
        <option value="MW">Malawi</option>
        <option value="MY">Malaysia</option>
        <option value="MV">Maldives</option>
        <option value="ML">Mali</option>
        <option value="MT">Malta</option>
        <option value="MH">Marshall Islands</option>
        <option value="MQ">Martinique</option>
        <option value="MR">Mauritania</option>
        <option value="MU">Mauritius</option>
        <option value="YT">Mayotte</option>
        <option value="MX">Mexico</option>
        <option value="FM">Micronesia</option>
        <option value="MD">Moldova</option>
        <option value="MC">Monaco</option>
        <option value="MN">Mongolia</option>
        <option value="ME">Montenegro</option>
        <option value="MS">Montserrat</option>
        <option value="MA">Morocco</option>
        <option value="MZ">Mozambique</option>
        <option value="MM">Myanmar</option>
        <option value="NA">Namibia</option>
        <option value="NR">Nauru</option>
        <option value="NP">Nepal</option>
        <option value="NL">Netherlands</option>
        <option value="NC">New Caledonia</option>
        <option value="NZ">New Zealand</option>
        <option value="NI">Nicaragua</option>
        <option value="NE">Niger</option>
        <option value="NG">Nigeria</option>
        <option value="NU">Niue</option>
        <option value="NF">Norfolk Island</option>
        <option value="KP">North Korea</option>
        <option value="MP">Northern Mariana Islands</option>
        <option value="NO">Norway</option>
        <option value="OM">Oman</option>
        <option value="PK">Pakistan</option>
        <option value="PW">Palau</option>
        <option value="PA">Panama</option>
        <option value="PG">Papua New Guinea</option>
        <option value="PY">Paraguay</option>
        <option value="PE">Peru</option>
        <option value="PH">Philippines</option>
        <option value="PL">Poland</option>
        <option value="PT">Portugal</option>
        <option value="PR">Puerto Rico</option>
        <option value="QA">Qatar</option>
        <option value="RO">Romania</option>
        <option value="RU">Russia</option>
        <option value="RW">Rwanda</option>
        <option value="RE">Réunion</option>
        <option value="BL">Saint Barthélemy</option>
        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
        <option value="KN">Saint Kitts and Nevis</option>
        <option value="LC">Saint Lucia</option>
        <option value="MF">Saint Martin</option>
        <option value="PM">Saint Pierre and Miquelon</option>
        <option value="VC">Saint Vincent and the Grenadines</option>
        <option value="WS">Samoa</option>
        <option value="SM">San Marino</option>
        <option value="ST">Sao Tome and Principe</option>
        <option value="SA">Saudi Arabia</option>
        <option value="SN">Senegal</option>
        <option value="RS">Serbia</option>
        <option value="SC">Seychelles</option>
        <option value="SL">Sierra Leone</option>
        <option value="SG">Singapore</option>
        <option value="SX">Sint Maarten</option>
        <option value="SK">Slovakia</option>
        <option value="SI">Slovenia</option>
        <option value="SB">Solomon Islands</option>
        <option value="SO">Somalia</option>
        <option value="ZA">South Africa</option>
        <option value="KR">South Korea</option>
        <option value="SS">South Sudan</option>
        <option value="ES">Spain</option>
        <option value="LK">Sri Lanka</option>
        <option value="SD">Sudan</option>
        <option value="SR">Suriname</option>
        <option value="SJ">Svalbard and Jan Mayen</option>
        <option value="SE">Sweden</option>
        <option value="CH">Switzerland</option>
        <option value="SY">Syria</option>
        <option value="TW">Taiwan</option>
        <option value="TJ">Tajikistan</option>
        <option value="TZ">Tanzania</option>
        <option value="TH">Thailand</option>
        <option value="TL">Timor-Leste</option>
        <option value="TG">Togo</option>
        <option value="TK">Tokelau</option>
        <option value="TO">Tonga</option>
        <option value="TT">Trinidad and Tobago</option>
        <option value="TN">Tunisia</option>
        <option value="TR">Turkey</option>
        <option value="TM">Turkmenistan</option>
        <option value="TC">Turks and Caicos Islands</option>
        <option value="TV">Tuvalu</option>
        <option value="UG">Uganda</option>
        <option value="UA">Ukraine</option>
        <option value="AE">United Arab Emirates</option>
        <option value="GB">United Kingdom</option>
        <option value="US">United States</option>
        <option value="UY">Uruguay</option>
        <option value="UZ">Uzbekistan</option>
        <option value="VU">Vanuatu</option>
        <option value="VE">Venezuela</option>
        <option value="VN">Vietnam</option>
        <option value="VG">Virgin Islands, British</option>
        <option value="VI">Virgin Islands, U.S.</option>
        <option value="WF">Wallis and Futuna</option>
        <option value="EH">Western Sahara</option>
        <option value="YE">Yemen</option>
        <option value="ZM">Zambia</option>
        <option value="ZW">Zimbabwe</option>
    </select>
    <x-input-error :messages="$errors->get('country')" class="mt-2" />
</div>


            <!-- Address Line 1 -->
            <div class="mt-4">
                <x-input-label for="address_line_1" :value="__('Address Line 1')" />
                <x-text-input id="address_line_1" class="block mt-3 w-full" type="text" name="address_line_1" :value="old('address_line_1')" required autocomplete="address_line_1" />
                <x-input-error :messages="$errors->get('address_line_1')" class="mt-2" />
            </div>

            <!-- Address Line 2 -->
            <div class="mt-4">
                <x-input-label for="address_line_2" :value="__('Address Line 2')" />
                <x-text-input id="address_line_2" class="block mt-3 w-full" type="text" name="address_line_2" :value="old('address_line_2')" required autocomplete="address_line_2" />
                <x-input-error :messages="$errors->get('address_line_2')" class="mt-2" />
            </div>

            <!-- Postcode -->
            <div class="mt-4">
                <x-input-label for="post_code" :value="__('Postcode')" />
                <x-text-input id="post_code" class="block mt-3 w-full" type="text" name="post_code" :value="old('post_code')" required autocomplete="postal-code" pattern="[A-Za-z0-9\s\-]{3,15}" />
                <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
            </div>

            <!-- County -->
            <div class="mt-4">
                <x-input-label for="county" :value="__('County')" />
                <x-text-input id="county" class="block mt-3 w-full" type="text" name="county" :value="old('county')" required autocomplete="county" />
                <x-input-error :messages="$errors->get('county')" class="mt-2" />
            </div>
        </div>

    </div>

    <!-- Submit Button aligned to the right -->
    <div class="mt-6 text-right">
        <x-primary-button class="ml-4">
            {{ __('Create Order') }}
        </x-primary-button>
    </div>


</div>
    </form>

</x-app-layout>