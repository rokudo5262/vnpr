<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

function pc_getLocationInfoByIp($photo_upload_ip){

		$ip  = $photo_upload_ip;
		$country="";
		$geoPlugin_array = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip) );
		$country = array ($geoPlugin_array['geoplugin_countryName'], $geoPlugin_array['geoplugin_city'], $geoPlugin_array['geoplugin_countryCode']);

	return $country;

}


function pcplugin_states($state_value)

    {
			if (isset($_GET['edit-user'])) {
				$nonevalue =  '<option value="0">' . __('None', 'photo-contest') . '</option>';
			}else{
				$nonevalue =  '';
			}

	$html = '<select name="state" id="pc_state" class="form-control">
	      '.$nonevalue.'
				<option '.($state_value == "Alabama" ? "selected" : "").' value="Alabama">Alabama</option>
				<option '.($state_value == "Alaska" ? "selected" : "").' value="Alaska">Alaska</option>
				<option '.($state_value == "Arizona" ? "selected" : "").' value="Arizona">Arizona</option>
				<option '.($state_value == "Arkansas" ? "selected" : "").' value="Arkansas">Arkansas</option>
				<option '.($state_value == "California" ? "selected" : "").' value="California">California</option>
				<option '.($state_value == "Colorado" ? "selected" : "").' value="Colorado">Colorado</option>
				<option '.($state_value == "Connecticut" ? "selected" : "").' value="Connecticut">Connecticut</option>
				<option '.($state_value == "Delaware" ? "selected" : "").' value="Delaware">Delaware</option>
				<option '.($state_value == "District Of Columbia" ? "selected" : "").' value="District Of Columbia">District Of Columbia</option>
				<option '.($state_value == "Florida" ? "selected" : "").' value="Florida">Florida</option>
				<option '.($state_value == "Georgia" ? "selected" : "").' value="Georgia">Georgia</option>
				<option '.($state_value == "Hawaii" ? "selected" : "").' value="Hawaii">Hawaii</option>
				<option '.($state_value == "Idaho" ? "selected" : "").' value="Idaho">Idaho</option>
				<option '.($state_value == "Illinois" ? "selected" : "").' value="Illinois">Illinois</option>
				<option '.($state_value == "Indiana" ? "selected" : "").' value="Indiana">Indiana</option>
				<option '.($state_value == "Iowa" ? "selected" : "").' value="Iowa">Iowa</option>
				<option '.($state_value == "Kansas" ? "selected" : "").' value="Kansas">Kansas</option>
				<option '.($state_value == "Kentucky" ? "selected" : "").' value="Kentucky">Kentucky</option>
				<option '.($state_value == "Louisiana" ? "selected" : "").' value="Louisiana">Louisiana</option>
				<option '.($state_value == "Maine" ? "selected" : "").' value="Maine">Maine</option>
				<option '.($state_value == "Maryland" ? "selected" : "").' value="Maryland">Maryland</option>
				<option '.($state_value == "Massachusetts" ? "selected" : "").' value="Massachusetts">Massachusetts</option>
				<option '.($state_value == "Michigan" ? "selected" : "").' value="Michigan">Michigan</option>
				<option '.($state_value == "Minnesota" ? "selected" : "").' value="Minnesota">Minnesota</option>
				<option '.($state_value == "Mississippi" ? "selected" : "").' value="Mississippi">Mississippi</option>
				<option '.($state_value == "Missouri" ? "selected" : "").' value="Missouri">Missouri</option>
				<option '.($state_value == "Montana" ? "selected" : "").' value="Montana">Montana</option>
				<option '.($state_value == "Nebraska" ? "selected" : "").' value="Nebraska">Nebraska</option>
				<option '.($state_value == "Nevada" ? "selected" : "").' value="Nevada">Nevada</option>
				<option '.($state_value == "New Hampshire" ? "selected" : "").' value="New Hampshire">New Hampshire</option>
				<option '.($state_value == "New Jersey" ? "selected" : "").' value="New Jersey">New Jersey</option>
				<option '.($state_value == "New Mexico" ? "selected" : "").' value="New Mexico">New Mexico</option>
				<option '.($state_value == "New York" ? "selected" : "").' value="New York">New York</option>
				<option '.($state_value == "North Carolina" ? "selected" : "").' value="North Carolina">North Carolina</option>
				<option '.($state_value == "North Dakota" ? "selected" : "").' value="North Dakota">North Dakota</option>
				<option '.($state_value == "Ohio" ? "selected" : "").' value="Ohio">Ohio</option>
				<option '.($state_value == "Oklahoma" ? "selected" : "").' value="Oklahoma">Oklahoma</option>
				<option '.($state_value == "Oregon" ? "selected" : "").' value="Oregon">Oregon</option>
				<option '.($state_value == "Pennsylvania" ? "selected" : "").' value="Pennsylvania">Pennsylvania</option>
				<option '.($state_value == "Rhode Island" ? "selected" : "").' value="Rhode Island">Rhode Island</option>
				<option '.($state_value == "South Carolina" ? "selected" : "").' value="South Carolina">South Carolina</option>
				<option '.($state_value == "South Dakota" ? "selected" : "").' value="South Dakota">South Dakota</option>
				<option '.($state_value == "Tennessee" ? "selected" : "").' value="Tennessee">Tennessee</option>
				<option '.($state_value == "Texas" ? "selected" : "").' value="Texas">Texas</option>
				<option '.($state_value == "Utah" ? "selected" : "").' value="Utah">Utah</option>
				<option '.($state_value == "Vermont" ? "selected" : "").' value="Vermont">Vermont</option>
				<option '.($state_value == "Virginia" ? "selected" : "").' value="Virginia">Virginia</option>
				<option '.($state_value == "Washington" ? "selected" : "").' value="Washington">Washington</option>
				<option '.($state_value == "West Virginia" ? "selected" : "").' value="West Virginia">West Virginia</option>
				<option '.($state_value == "Wisconsin" ? "selected" : "").' value="Wisconsin">Wisconsin</option>
				<option '.($state_value == "Wyoming" ? "selected" : "").' value="Wyoming">Wyoming</option>
				<option '.($state_value == "American Samoa" ? "selected" : "").' value="American Samoa">American Samoa (United States Territory)</option>
				<option '.($state_value == "Guam" ? "selected" : "").' value="Guam">Guam (United States Territory)</option>
				<option '.($state_value == "Northern Mariana Islands" ? "selected" : "").' value="Northern Mariana Islands">Northern Mariana Islands (United States Territory)</option>
				<option '.($state_value == "Puerto Rico" ? "selected" : "").' value="Puerto Rico">Puerto Rico (United States Territory)</option>
				<option '.($state_value == "United States Minor Outlying Island" ? "selected" : "").' value="United States Minor Outlying Island">United States Minor Outlying Islands (United States Territory)</option>
				<option '.($state_value == "Virgin Islands" ? "selected" : "").' value="Virgin Islands">Virgin Islands (United States Territory)</option>

				</select>';



				return $html;



    }

function pcplugin_countries($country_value)

    {
			if (isset($_GET['edit-user'])) {
			$nonevalue =  '<option value="0">' . __('None', 'photo-contest') . '</option>';
			}else{
			$nonevalue =  '';
			}

		$html = '<select name="country" id="pc_country" class="form-control">
		    <option disabled>'. __('Select Country', 'photo-contest') . '</option>
				'.$nonevalue.'
				<option disabled>----------</option>
				<option '.($country_value == "United States" ? "selected" : "").' value="United States">United States</option>
        <option '.($country_value == "United Kingdom" ? "selected" : "").' value="United Kingdom">United Kingdom</option>
        <option disabled>----------</option>
				<option '.($country_value == "Afghanistan" ? "selected" : "").' value="Afghanistan">Afghanistan</option>
				<option '.($country_value == "Åland Islands" ? "selected" : "").' value="Åland Islands">Åland Islands</option>
				<option '.($country_value == "Albania" ? "selected" : "").' value="Albania">Albania</option>
				<option '.($country_value == "Algeria" ? "selected" : "").' value="Algeria">Algeria</option>
				<option '.($country_value == "American Samoa" ? "selected" : "").' value="American Samoa">American Samoa</option>
				<option '.($country_value == ">Andorra" ? "selected" : "").' value=">Andorra">Andorra</option>
				<option '.($country_value == "Angola" ? "selected" : "").' value="Angola">Angola</option>
				<option '.($country_value == "Anguilla" ? "selected" : "").' value="Anguilla">Anguilla</option>
				<option '.($country_value == "Antarctica" ? "selected" : "").' value="Antarctica">Antarctica</option>
				<option '.($country_value == "Antigua and Barbuda" ? "selected" : "").' value="Antigua and Barbuda">Antigua and Barbuda</option>
				<option '.($country_value == "Argentina" ? "selected" : "").' value="Argentina">Argentina</option>
				<option '.($country_value == "Armenia" ? "selected" : "").' value="Armenia">Armenia</option>
				<option '.($country_value == "Aruba" ? "selected" : "").' value="Aruba">Aruba</option>
				<option '.($country_value == "Australia" ? "selected" : "").' value="Australia">Australia</option>
				<option '.($country_value == "Austria" ? "selected" : "").' value="Austria">Austria</option>
				<option '.($country_value == "Azerbaijan" ? "selected" : "").' value="Azerbaijan">Azerbaijan</option>
				<option '.($country_value == "Bahamas" ? "selected" : "").' value="Bahamas">Bahamas</option>
				<option '.($country_value == "Bahrain" ? "selected" : "").' value="Bahrain">Bahrain</option>
				<option '.($country_value == "Bangladesh" ? "selected" : "").' value="Bangladesh">Bangladesh</option>
				<option '.($country_value == "Barbados" ? "selected" : "").' value="Barbados">Barbados</option>
				<option '.($country_value == "Belarus" ? "selected" : "").' value="Belarus">Belarus</option>
				<option '.($country_value == "Belgium" ? "selected" : "").' value="Belgium">Belgium</option>
				<option '.($country_value == "Belize" ? "selected" : "").' value="Belize">Belize</option>
				<option '.($country_value == "Benin" ? "selected" : "").' value="Benin">Benin</option>
				<option '.($country_value == "Bermuda" ? "selected" : "").' value="Bermuda">Bermuda</option>
				<option '.($country_value == "Bhutan" ? "selected" : "").' value="Bhutan">Bhutan</option>
				<option '.($country_value == "Bolivia, Plurinational State of" ? "selected" : "").' value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
				<option '.($country_value == "Bonaire, Sint Eustatius and Saba" ? "selected" : "").' value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
				<option '.($country_value == "Bosnia and Herzegovina" ? "selected" : "").' value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
				<option '.($country_value == "Botswana" ? "selected" : "").' value="Botswana">Botswana</option>
				<option '.($country_value == "Bouvet Island" ? "selected" : "").' value="Bouvet Island">Bouvet Island</option>
				<option '.($country_value == "Brazil" ? "selected" : "").' value="Brazil">Brazil</option>
				<option '.($country_value == "British Indian Ocean Territory" ? "selected" : "").' value="British Indian Ocean Territory">British Indian Ocean Territory</option>
				<option '.($country_value == "Brunei Darussalam" ? "selected" : "").' value="Brunei Darussalam">Brunei Darussalam</option>
				<option '.($country_value == "Bulgaria" ? "selected" : "").' value="Bulgaria">Bulgaria</option>
				<option '.($country_value == "Burkina Faso" ? "selected" : "").' value="Burkina Faso">Burkina Faso</option>
				<option '.($country_value == "Burundi" ? "selected" : "").' value="Burundi">Burundi</option>
				<option '.($country_value == "Cambodia" ? "selected" : "").' value="Cambodia">Cambodia</option>
				<option '.($country_value == "Cameroon" ? "selected" : "").' value="Cameroon">Cameroon</option>
				<option '.($country_value == "Canada" ? "selected" : "").' value="Canada">Canada</option>
				<option '.($country_value == "Cape Verde" ? "selected" : "").' value="Cape Verde">Cape Verde</option>
				<option '.($country_value == "Cayman Islands" ? "selected" : "").' value="Cayman Islands">Cayman Islands</option>
				<option '.($country_value == "Central African Republic" ? "selected" : "").' value="Central African Republic">Central African Republic</option>
				<option '.($country_value == "Chad" ? "selected" : "").' value="Chad">Chad</option>
				<option '.($country_value == "Chile" ? "selected" : "").' value="Chile">Chile</option>
				<option '.($country_value == "China" ? "selected" : "").' value="China">China</option>
				<option '.($country_value == "Christmas Island" ? "selected" : "").' value="Christmas Island">Christmas Island</option>
				<option '.($country_value == "Cocos (Keeling) Islands" ? "selected" : "").' value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
				<option '.($country_value == "Colombia" ? "selected" : "").' value="Colombia">Colombia</option>
				<option '.($country_value == "Comoros" ? "selected" : "").' value="Comoros">Comoros</option>
				<option '.($country_value == "Congo" ? "selected" : "").' value="Congo">Congo</option>
				<option '.($country_value == "Congo, the Democratic Republic of the" ? "selected" : "").' value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
				<option '.($country_value == "Cook Islands" ? "selected" : "").' value="Cook Islands">Cook Islands</option>
				<option '.($country_value == "Costa Rica" ? "selected" : "").' value="Costa Rica">Costa Rica</option>
				<option '.($country_value == "Côte d\'Ivoire" ? "selected" : "").' value="Côte d\'Ivoire">Côte d\'Ivoire</option>
				<option '.($country_value == "Croatia" ? "selected" : "").' value="Croatia">Croatia</option>
				<option '.($country_value == "Cuba" ? "selected" : "").' value="Cuba">Cuba</option>
				<option '.($country_value == "Curaçao" ? "selected" : "").' value="Curaçao">Curaçao</option>
				<option '.($country_value == "Cyprus" ? "selected" : "").' value="Cyprus">Cyprus</option>
				<option '.($country_value == "Czech Republic" ? "selected" : "").' value="Czech Republic">Czech Republic</option>
				<option '.($country_value == "Denmark" ? "selected" : "").' value="Denmark">Denmark</option>
				<option '.($country_value == "Djibouti" ? "selected" : "").' value="Djibouti">Djibouti</option>
				<option '.($country_value == "Dominica" ? "selected" : "").' value="Dominica">Dominica</option>
				<option '.($country_value == "Dominican Republic" ? "selected" : "").' value="Dominican Republic">Dominican Republic</option>
				<option '.($country_value == "Ecuador" ? "selected" : "").' value="Ecuador">Ecuador</option>
				<option '.($country_value == "Egypt" ? "selected" : "").' value="Egypt">Egypt</option>
				<option '.($country_value == "El Salvador" ? "selected" : "").' value="El Salvador">El Salvador</option>
				<option '.($country_value == "Equatorial Guinea" ? "selected" : "").' value="Equatorial Guinea">Equatorial Guinea</option>
				<option '.($country_value == "Eritrea" ? "selected" : "").' value="Eritrea">Eritrea</option>
				<option '.($country_value == "Estonia" ? "selected" : "").' value="Estonia">Estonia</option>
				<option '.($country_value == "Ethiopia" ? "selected" : "").' value="Ethiopia">Ethiopia</option>
				<option '.($country_value == "Falkland Islands (Malvinas)" ? "selected" : "").' value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
				<option '.($country_value == "Faroe Islands" ? "selected" : "").' value="Faroe Islands">Faroe Islands</option>
				<option '.($country_value == "Fiji" ? "selected" : "").' value="Fiji">Fiji</option>
				<option '.($country_value == "Finland" ? "selected" : "").' value="Finland">Finland</option>
				<option '.($country_value == "France" ? "selected" : "").' value="France">France</option>
				<option '.($country_value == "French Guiana" ? "selected" : "").' value="French Guiana">French Guiana</option>
				<option '.($country_value == "French Polynesia" ? "selected" : "").' value="French Polynesia">French Polynesia</option>
				<option '.($country_value == "French Southern Territories" ? "selected" : "").' value="French Southern Territories">French Southern Territories</option>
				<option '.($country_value == "Gabon" ? "selected" : "").' value="Gabon">Gabon</option>
				<option '.($country_value == "Gambia" ? "selected" : "").' value="Gambia">Gambia</option>
				<option '.($country_value == "Georgia" ? "selected" : "").' value="Georgia">Georgia</option>
				<option '.($country_value == "Germany" ? "selected" : "").' value="Germany">Germany</option>
				<option '.($country_value == "Ghana" ? "selected" : "").' value="Ghana">Ghana</option>
				<option '.($country_value == "Gibraltar" ? "selected" : "").' value="Gibraltar">Gibraltar</option>
				<option '.($country_value == "Greece" ? "selected" : "").' value="Greece">Greece</option>
				<option '.($country_value == "Greenland" ? "selected" : "").' value="Greenland">Greenland</option>
				<option '.($country_value == "Grenada" ? "selected" : "").' value="Grenada">Grenada</option>
				<option '.($country_value == "Guadeloupe" ? "selected" : "").' value="Guadeloupe">Guadeloupe</option>
				<option '.($country_value == "Guam" ? "selected" : "").' value="Guam">Guam</option>
				<option '.($country_value == "Guatemala" ? "selected" : "Guatemala").' value="Guatemala">Guatemala</option>
				<option '.($country_value == "Guernsey" ? "selected" : "").' value="Guernsey">Guernsey</option>
				<option '.($country_value == "Guinea" ? "selected" : "").' value="Guinea">Guinea</option>
				<option '.($country_value == "Guinea-Bissau" ? "selected" : "").' value="Guinea-Bissau">Guinea-Bissau</option>
				<option '.($country_value == "Guyana" ? "selected" : "").' value="Guyana">Guyana</option>
				<option '.($country_value == "Haiti" ? "selected" : "").' value="Haiti">Haiti</option>
				<option '.($country_value == "Heard Island and McDonald Islands" ? "selected" : "").' value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
				<option '.($country_value == "Holy See (Vatican City State)" ? "selected" : "").' value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
				<option '.($country_value == "Honduras" ? "selected" : "").' value="Honduras">Honduras</option>
				<option '.($country_value == "Hong Kong" ? "selected" : "").' value="Hong Kong">Hong Kong</option>
				<option '.($country_value == "Hungary" ? "selected" : "").' value="Hungary">Hungary</option>
				<option '.($country_value == "Iceland" ? "selected" : "").' value="Iceland">Iceland</option>
				<option '.($country_value == "India" ? "selected" : "").' value="India">India</option>
				<option '.($country_value == "Indonesia" ? "selected" : "").' value="Indonesia">Indonesia</option>
				<option '.($country_value == "Iran, Islamic Republic of" ? "selected" : "").' value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
				<option '.($country_value == "Iraq" ? "selected" : "").' value="Iraq">Iraq</option>
				<option '.($country_value == "Ireland" ? "selected" : "").' value="Ireland">Ireland</option>
				<option '.($country_value == "Isle of Man" ? "selected" : "").' value="Isle of Man">Isle of Man</option>
				<option '.($country_value == "Israel" ? "selected" : "").' value="Israel">Israel</option>
				<option '.($country_value == "Italy" ? "selected" : "").' value="Italy">Italy</option>
				<option '.($country_value == "Jamaica" ? "selected" : "").' value="Jamaica">Jamaica</option>
				<option '.($country_value == "Japan" ? "selected" : "").' value="Japan">Japan</option>
				<option '.($country_value == "Jersey" ? "selected" : "").' value="Jersey">Jersey</option>
				<option '.($country_value == "Jordan" ? "selected" : "").' value="Jordan">Jordan</option>
				<option '.($country_value == "Kazakhstan" ? "selected" : "").' value="Kazakhstan">Kazakhstan</option>
				<option '.($country_value == "Kenya" ? "selected" : "").' value="Kenya">Kenya</option>
				<option '.($country_value == "Kiribati" ? "selected" : "").' value="Kiribati">Kiribati</option>
				<option '.($country_value == "Korea, Democratic People\'s Republic of" ? "selected" : "").' value="Korea, Democratic People\'s Republic of">Korea, Democratic People\'s Republic of</option>
				<option '.($country_value == "Korea, Republic of" ? "selected" : "").' value="Korea, Republic of">Korea, Republic of</option>
				<option '.($country_value == "Kuwait" ? "selected" : "").' value="Kuwait">Kuwait</option>
				<option '.($country_value == "Kyrgyzstan" ? "selected" : "").' value="Kyrgyzstan">Kyrgyzstan</option>
				<option '.($country_value == "Lao People\'s Democratic Republic" ? "selected" : "").' value="Lao People\'s Democratic Republic">Lao People\'s Democratic Republic</option>
				<option '.($country_value == "Latvia" ? "selected" : "").' value="Latvia">Latvia</option>
				<option '.($country_value == "Lebanon" ? "selected" : "").' value="Lebanon">Lebanon</option>
				<option '.($country_value == "Lesotho" ? "selected" : "").' value="Lesotho">Lesotho</option>
				<option '.($country_value == "Liberia" ? "selected" : "").' value="Liberia">Liberia</option>
				<option '.($country_value == "Libya" ? "selected" : "").' value="Libya">Libya</option>
				<option '.($country_value == "Liechtenstein" ? "selected" : "").' value="Liechtenstein">Liechtenstein</option>
				<option '.($country_value == "Lithuania" ? "selected" : "").' value="Lithuania">Lithuania</option>
				<option '.($country_value == "Luxembourg" ? "selected" : "").' value="Luxembourg">Luxembourg</option>
				<option '.($country_value == "Macao" ? "selected" : "").' value="Macao">Macao</option>
				<option '.($country_value == "Macedonia, the former Yugoslav Republic of" ? "selected" : "").' value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
				<option '.($country_value == "Madagascar" ? "selected" : "").' value="Madagascar">Madagascar</option>
				<option '.($country_value == "Malawi" ? "selected" : "").' value="Malawi">Malawi</option>
				<option '.($country_value == "Malaysia" ? "selected" : "").' value="Malaysia">Malaysia</option>
				<option '.($country_value == "Maldives" ? "selected" : "").' value="Maldives">Maldives</option>
				<option '.($country_value == "Mali" ? "selected" : "").' value="Mali">Mali</option>
				<option '.($country_value == "Malta" ? "selected" : "").' value="Malta">Malta</option>
				<option '.($country_value == "Marshall Islands" ? "selected" : "").' value="Marshall Islands">Marshall Islands</option>
				<option '.($country_value == "Martinique" ? "selected" : "").' value="Martinique">Martinique</option>
				<option '.($country_value == "Mauritania" ? "selected" : "").' value="Mauritania">Mauritania</option>
				<option '.($country_value == "Mauritius" ? "selected" : "").' value="Mauritius">Mauritius</option>
				<option '.($country_value == "Mayotte" ? "selected" : "").' value="Mayotte">Mayotte</option>
				<option '.($country_value == "Mexico" ? "selected" : "").' value="Mexico">Mexico</option>
				<option '.($country_value == "Micronesia, Federated States of" ? "selected" : "").' value="Micronesia, Federated States of">Micronesia, Federated States of</option>
				<option '.($country_value == "Moldova, Republic of" ? "selected" : "").' value="Moldova, Republic of">Moldova, Republic of</option>
				<option '.($country_value == "Monaco" ? "selected" : "").' value="Monaco">Monaco</option>
				<option '.($country_value == "Mongolia" ? "selected" : "").' value="Mongolia">Mongolia</option>
				<option '.($country_value == "Montenegro" ? "selected" : "").' value="Montenegro">Montenegro</option>
				<option '.($country_value == "Montserrat" ? "selected" : "").' value="Montserrat">Montserrat</option>
				<option '.($country_value == "Morocco" ? "selected" : "").' value="Morocco">Morocco</option>
				<option '.($country_value == "Mozambique" ? "selected" : "").' value="Mozambique">Mozambique</option>
				<option '.($country_value == "Myanmar" ? "selected" : "").' value="Myanmar">Myanmar</option>
				<option '.($country_value == "Namibia" ? "selected" : "").' value="Namibia">Namibia</option>
				<option '.($country_value == "Nauru" ? "selected" : "").' value="Nauru">Nauru</option>
				<option '.($country_value == "Nepal" ? "selected" : "").' value="Nepal">Nepal</option>
				<option '.($country_value == "Netherlands" ? "selected" : "").' value="Netherlands">Netherlands</option>
				<option '.($country_value == "New Caledonia" ? "selected" : "").' value="New Caledonia">New Caledonia</option>
				<option '.($country_value == "New Zealand" ? "selected" : "").' value="New Zealand">New Zealand</option>
				<option '.($country_value == "Nicaragua" ? "selected" : "").' value="Nicaragua">Nicaragua</option>
				<option '.($country_value == "Niger" ? "selected" : "").' value="Niger">Niger</option>
				<option '.($country_value == "Nigeria" ? "selected" : "").' value="Nigeria">Nigeria</option>
				<option '.($country_value == "Niue" ? "selected" : "").' value="Niue">Niue</option>
				<option '.($country_value == "Norfolk Island" ? "selected" : "").' value="Norfolk Island">Norfolk Island</option>
				<option '.($country_value == "Northern Mariana Islands" ? "selected" : "").' value="Northern Mariana Islands">Northern Mariana Islands</option>
				<option '.($country_value == "Norway" ? "selected" : "").' value="Norway">Norway</option>
				<option '.($country_value == "Oman" ? "selected" : "").' value="Oman">Oman</option>
				<option '.($country_value == "Pakistan" ? "selected" : "").' value="Pakistan">Pakistan</option>
				<option '.($country_value == "Palau" ? "selected" : "").' value="Palau">Palau</option>
				<option '.($country_value == "Palestinian Territory, Occupied" ? "selected" : "").' value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
				<option '.($country_value == "Panama" ? "selected" : "").' value="Panama">Panama</option>
				<option '.($country_value == "Papua New Guinea" ? "selected" : "").' value="Papua New Guinea">Papua New Guinea</option>
				<option '.($country_value == "Paraguay" ? "selected" : "").' value="Paraguay">Paraguay</option>
				<option '.($country_value == "Peru" ? "selected" : "").' value="Peru">Peru</option>
				<option '.($country_value == "Philippines" ? "selected" : "").' value="Philippines">Philippines</option>
				<option '.($country_value == "Pitcairn" ? "selected" : "").' value="Pitcairn">Pitcairn</option>
				<option '.($country_value == "Poland" ? "selected" : "").' value="Poland">Poland</option>
				<option '.($country_value == "Portugal" ? "selected" : "").' value="Portugal">Portugal</option>
				<option '.($country_value == "Puerto Rico" ? "selected" : "").' value="Puerto Rico">Puerto Rico</option>
				<option '.($country_value == "Qatar" ? "selected" : "").' value="Qatar">Qatar</option>
				<option '.($country_value == "Réunion" ? "selected" : "").' value="Réunion">Réunion</option>
				<option '.($country_value == "Romania" ? "selected" : "").' value="Romania">Romania</option>
				<option '.($country_value == "Russian Federation" ? "selected" : "").' value="Russian Federation">Russian Federation</option>
				<option '.($country_value == "Rwanda" ? "selected" : "").' value="Rwanda">Rwanda</option>
				<option '.($country_value == "Saint Barthélemy" ? "selected" : "").' value="Saint Barthélemy">Saint Barthélemy</option>
				<option '.($country_value == "Saint Helena, Ascension and Tristan da Cunha" ? "selected" : "").' value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
				<option '.($country_value == "Saint Kitts and Nevis" ? "selected" : "").' value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
				<option '.($country_value == "Saint Lucia" ? "selected" : "").' value="Saint Lucia">Saint Lucia</option>
				<option '.($country_value == "Saint Martin (French part)" ? "selected" : "").' value="Saint Martin (French part)">Saint Martin (French part)</option>
				<option '.($country_value == "Saint Pierre and Miquelon" ? "selected" : "").' value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
				<option '.($country_value == "Saint Vincent and the Grenadines" ? "selected" : "").' value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
				<option '.($country_value == "Samoa" ? "selected" : "").' value="Samoa">Samoa</option>
				<option '.($country_value == "San Marino" ? "selected" : "").' value="San Marino">San Marino</option>
				<option '.($country_value == "Sao Tome and Principe" ? "selected" : "").' value="Sao Tome and Principe">Sao Tome and Principe</option>
				<option '.($country_value == "Saudi Arabia" ? "selected" : "").' value="Saudi Arabia">Saudi Arabia</option>
				<option '.($country_value == "Senegal" ? "selected" : "").' value="Senegal">Senegal</option>
				<option '.($country_value == "Serbia" ? "selected" : "").' value="Serbia">Serbia</option>
				<option '.($country_value == "Seychelles" ? "selected" : "").' value="Seychelles">Seychelles</option>
				<option '.($country_value == "Sierra Leone" ? "selected" : "").' value="Sierra Leone">Sierra Leone</option>
				<option '.($country_value == "Singapore" ? "selected" : "").' value="Singapore">Singapore</option>
				<option '.($country_value == "Sint Maarten (Dutch part)" ? "selected" : "").' value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
				<option '.($country_value == "Slovakia" ? "selected" : "").' value="Slovakia">Slovakia</option>
				<option '.($country_value == "Slovenia" ? "selected" : "").' value="Slovenia">Slovenia</option>
				<option '.($country_value == "Solomon Islands" ? "selected" : "").' value="Solomon Islands">Solomon Islands</option>
				<option '.($country_value == "Somalia" ? "selected" : "").' value="Somalia">Somalia</option>
				<option '.($country_value == "South Africa" ? "selected" : "").' value="South Africa">South Africa</option>
				<option '.($country_value == "South Georgia and the South Sandwich Islands" ? "selected" : "").' value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
				<option '.($country_value == "South Sudan" ? "selected" : "").' value="South Sudan">South Sudan</option>
				<option '.($country_value == "Spain" ? "selected" : "").' value="Spain">Spain</option>
				<option '.($country_value == "Sri Lanka" ? "selected" : "").' value="Sri Lanka">Sri Lanka</option>
				<option '.($country_value == "Sudan" ? "selected" : "").' value="Sudan">Sudan</option>
				<option '.($country_value == "Suriname" ? "selected" : "").' value="Suriname">Suriname</option>
				<option '.($country_value == "Svalbard and Jan Mayen" ? "selected" : "").' value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
				<option '.($country_value == "Swaziland" ? "selected" : "").' value="Swaziland">Swaziland</option>
				<option '.($country_value == "Sweden" ? "selected" : "").' value="Sweden">Sweden</option>
				<option '.($country_value == "Switzerland" ? "selected" : "").' value="Switzerland">Switzerland</option>
				<option '.($country_value == "Syrian Arab Republic" ? "selected" : "").' value="Syrian Arab Republic">Syrian Arab Republic</option>
				<option '.($country_value == "Taiwan, Province of China" ? "selected" : "").' value="Taiwan, Province of China">Taiwan, Province of China</option>
				<option '.($country_value == "Tajikistan" ? "selected" : "").' value="Tajikistan">Tajikistan</option>
				<option '.($country_value == "Tanzania, United Republic of" ? "selected" : "").' value="Tanzania, United Republic of">Tanzania, United Republic of</option>
				<option '.($country_value == "Thailand" ? "selected" : "").' value="Thailand">Thailand</option>
				<option '.($country_value == "Timor-Leste" ? "selected" : "").' value="Timor-Leste">Timor-Leste</option>
				<option '.($country_value == "Togo" ? "selected" : "").' value="Togo">Togo</option>
				<option '.($country_value == "Tokelau" ? "selected" : "").' value="Tokelau">Tokelau</option>
				<option '.($country_value == "Tonga" ? "selected" : "").' value="Tonga">Tonga</option>
				<option '.($country_value == "Trinidad and Tobago" ? "selected" : "").' value="Trinidad and Tobago">Trinidad and Tobago</option>
				<option '.($country_value == "Tunisia" ? "selected" : "").' value="Tunisia">Tunisia</option>
				<option '.($country_value == "Turkey" ? "selected" : "").' value="Turkey">Turkey</option>
				<option '.($country_value == "Turkmenistan" ? "selected" : "").' value="Turkmenistan">Turkmenistan</option>
				<option '.($country_value == "Turks and Caicos Islands" ? "selected" : "").' value="Turks and Caicos Islands">Turks and Caicos Islands</option>
				<option '.($country_value == "Tuvalu" ? "selected" : "").' value="Tuvalu">Tuvalu</option>
				<option '.($country_value == "Uganda" ? "selected" : "").' value="Uganda">Uganda</option>
				<option '.($country_value == "Ukraine" ? "selected" : "").' value="Ukraine">Ukraine</option>
				<option '.($country_value == "United Arab Emirates" ? "selected" : "").' value="United Arab Emirates">United Arab Emirates</option>
				<option '.($country_value == "United States Minor Outlying Islands" ? "selected" : "").' value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
				<option '.($country_value == "Uruguay" ? "selected" : "").' value="Uruguay">Uruguay</option>
				<option '.($country_value == "Uzbekistan" ? "selected" : "").' value="Uzbekistan">Uzbekistan</option>
				<option '.($country_value == "Vanuatu" ? "selected" : "").' value="Vanuatu">Vanuatu</option>
				<option '.($country_value == "Venezuela, Bolivarian Republic of" ? "selected" : "").' value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
				<option '.($country_value == "Viet Nam" ? "selected" : "").' value="Viet Nam">Viet Nam</option>
				<option '.($country_value == "Virgin Islands, British" ? "selected" : "").' value="Virgin Islands, British">Virgin Islands, British</option>
				<option '.($country_value == "Virgin Islands, U.S." ? "selected" : "").' value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
				<option '.($country_value == "Wallis and Futuna" ? "selected" : "").' value="Wallis and Futuna">Wallis and Futuna</option>
				<option '.($country_value == "Western Sahara" ? "selected" : "").' value="Western Sahara">Western Sahara</option>
				<option '.($country_value == "Yemen" ? "selected" : "").' value="Yemen">Yemen</option>
				<option '.($country_value == "Zambia" ? "selected" : "").' value="Zambia">Zambia</option>
				<option '.($country_value == "Zimbabwe" ? "selected" : "").' value="Zimbabwe">Zimbabwe</option>
				</select>';
				return $html;

		}



		function pcplugin_datepicker_java()

		{
			$html = '<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
			<script type="text/javascript">
			function loadCSS(filename){
			var file = document.createElement("link")
			file.setAttribute("rel", "stylesheet")
			file.setAttribute("type", "text/css")
			file.setAttribute("href", filename)
			if (typeof file !== "undefined")
			document.getElementsByTagName("head")[0].appendChild(file)
			}
			//just call a function to load a new CSS:
			loadCSS("https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css")
			</script>
			<script>
			$(function() {
			$( "#dateofbirth" ).datepicker({ dateFormat: "mm/dd/yy",changeMonth: true,changeYear: true,yearRange: "-100:+0",monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],monthNamesShort: ["1","2","3","4","5","6","7","8","9","10","11","12"] });
			});
			</script>';

			return $html;
		}

		function pcplugin_countries_for_votes_filter($country_value)
		{
			$html = '<option '.($country_value == "AF" ? "selected" : "").' value="AF">Afghanistan</option>
			<option '.($country_value == "AX" ? "selected" : "").' value="AX">Åland Islands</option>
			<option '.($country_value == "AL" ? "selected" : "").' value="AL">Albania</option>
			<option '.($country_value == "DZ" ? "selected" : "").' value="DZ">Algeria</option>
			<option '.($country_value == "AS" ? "selected" : "").' value="AS">American Samoa</option>
			<option '.($country_value == "AD" ? "selected" : "").' value="AD">Andorra</option>
			<option '.($country_value == "AO" ? "selected" : "").' value="AO">Angola</option>
			<option '.($country_value == "AI" ? "selected" : "").' value="AI">Anguilla</option>
			<option '.($country_value == "AQ" ? "selected" : "").' value="AQ">Antarctica</option>
			<option '.($country_value == "AG" ? "selected" : "").' value="AG">Antigua and Barbuda</option>
			<option '.($country_value == "AR" ? "selected" : "").' value="AR">Argentina</option>
			<option '.($country_value == "AM" ? "selected" : "").' value="AM">Armenia</option>
			<option '.($country_value == "AW" ? "selected" : "").' value="AW">Aruba</option>
			<option '.($country_value == "AU" ? "selected" : "").' value="AU">Australia</option>
			<option '.($country_value == "AT" ? "selected" : "").' value="AT">Austria</option>
			<option '.($country_value == "AZ" ? "selected" : "").' value="AZ">Azerbaijan</option>
			<option '.($country_value == "BS" ? "selected" : "").' value="BS">Bahamas</option>
			<option '.($country_value == "BH" ? "selected" : "").' value="BH">Bahrain</option>
			<option '.($country_value == "BD" ? "selected" : "").' value="BD">Bangladesh</option>
			<option '.($country_value == "BB" ? "selected" : "").' value="BB">Barbados</option>
			<option '.($country_value == "BY" ? "selected" : "").' value="BY">Belarus</option>
			<option '.($country_value == "BE" ? "selected" : "").' value="BE">Belgium</option>
			<option '.($country_value == "BZ" ? "selected" : "").' value="BZ">Belize</option>
			<option '.($country_value == "BJ" ? "selected" : "").' value="BJ">Benin</option>
			<option '.($country_value == "BM" ? "selected" : "").' value="BM">Bermuda</option>
			<option '.($country_value == "BT" ? "selected" : "").' value="BT">Bhutan</option>
			<option '.($country_value == "BO" ? "selected" : "").' value="BO">Bolivia, Plurinational State of</option>
			<option '.($country_value == "BQ" ? "selected" : "").' value="BQ">Bonaire, Sint Eustatius and Saba</option>
			<option '.($country_value == "BA" ? "selected" : "").' value="BA">Bosnia and Herzegovina</option>
			<option '.($country_value == "BW" ? "selected" : "").' value="BW">Botswana</option>
			<option '.($country_value == "BV" ? "selected" : "").' value="BV">Bouvet Island</option>
			<option '.($country_value == "BR" ? "selected" : "").' value="BR">Brazil</option>
			<option '.($country_value == "IO" ? "selected" : "").' value="IO">British Indian Ocean Territory</option>
			<option '.($country_value == "BN" ? "selected" : "").' value="BN">Brunei Darussalam</option>
			<option '.($country_value == "BG" ? "selected" : "").' value="BG">Bulgaria</option>
			<option '.($country_value == "BF" ? "selected" : "").' value="BF">Burkina Faso</option>
			<option '.($country_value == "BI" ? "selected" : "").' value="BI">Burundi</option>
			<option '.($country_value == "KH" ? "selected" : "").' value="KH">Cambodia</option>
			<option '.($country_value == "CM" ? "selected" : "").' value="CM">Cameroon</option>
			<option '.($country_value == "CA" ? "selected" : "").' value="CA">Canada</option>
			<option '.($country_value == "CV" ? "selected" : "").' value="CV">Cape Verde</option>
			<option '.($country_value == "KY" ? "selected" : "").' value="KY">Cayman Islands</option>
			<option '.($country_value == "CF" ? "selected" : "").' value="CF">Central African Republic</option>
			<option '.($country_value == "TD" ? "selected" : "").' value="TD">Chad</option>
			<option '.($country_value == "CL" ? "selected" : "").' value="CL">Chile</option>
			<option '.($country_value == "CN" ? "selected" : "").' value="CN">China</option>
			<option '.($country_value == "CX" ? "selected" : "").' value="CX">Christmas Island</option>
			<option '.($country_value == "CC" ? "selected" : "").' value="CC">Cocos (Keeling) Islands</option>
			<option '.($country_value == "CO" ? "selected" : "").' value="CO">Colombia</option>
			<option '.($country_value == "KM" ? "selected" : "").' value="KM">Comoros</option>
			<option '.($country_value == "CG" ? "selected" : "").' value="CG">Congo</option>
			<option '.($country_value == "CD" ? "selected" : "").' value="CD">Congo, the Democratic Republic of the</option>
			<option '.($country_value == "CK" ? "selected" : "").' value="CK">Cook Islands</option>
			<option '.($country_value == "CR" ? "selected" : "").' value="CR">Costa Rica</option>
			<option '.($country_value == "CI" ? "selected" : "").' value="CI">Côte d\'Ivoire</option>
			<option '.($country_value == "HR" ? "selected" : "").' value="HR">Croatia</option>
			<option '.($country_value == "CU" ? "selected" : "").' value="CU">Cuba</option>
			<option '.($country_value == "CW" ? "selected" : "").' value="CW">Curaçao</option>
			<option '.($country_value == "CY" ? "selected" : "").' value="CY">Cyprus</option>
			<option '.($country_value == "CZ" ? "selected" : "").' value="CZ">Czech Republic</option>
			<option '.($country_value == "DK" ? "selected" : "").' value="DK">Denmark</option>
			<option '.($country_value == "DJ" ? "selected" : "").' value="DJ">Djibouti</option>
			<option '.($country_value == "DM" ? "selected" : "").' value="DM">Dominica</option>
			<option '.($country_value == "DO" ? "selected" : "").' value="DO">Dominican Republic</option>
			<option '.($country_value == "EC" ? "selected" : "").' value="EC">Ecuador</option>
			<option '.($country_value == "EG" ? "selected" : "").' value="EG">Egypt</option>
			<option '.($country_value == "SV" ? "selected" : "").' value="SV">El Salvador</option>
			<option '.($country_value == "GQ" ? "selected" : "").' value="GQ">Equatorial Guinea</option>
			<option '.($country_value == "ER" ? "selected" : "").' value="ER">Eritrea</option>
			<option '.($country_value == "EE" ? "selected" : "").' value="EE">Estonia</option>
			<option '.($country_value == "ET" ? "selected" : "").' value="ET">Ethiopia</option>
			<option '.($country_value == "FK" ? "selected" : "").' value="FK">Falkland Islands (Malvinas)</option>
			<option '.($country_value == "FO" ? "selected" : "").' value="FO">Faroe Islands</option>
			<option '.($country_value == "FJ" ? "selected" : "").' value="FJ">Fiji</option>
			<option '.($country_value == "FI" ? "selected" : "").' value="FI">Finland</option>
			<option '.($country_value == "FR" ? "selected" : "").' value="FR">France</option>
			<option '.($country_value == "GF" ? "selected" : "").' value="GF">French Guiana</option>
			<option '.($country_value == "PF" ? "selected" : "").' value="PF">French Polynesia</option>
			<option '.($country_value == "TF" ? "selected" : "").' value="TF">French Southern Territories</option>
			<option '.($country_value == "GA" ? "selected" : "").' value="GA">Gabon</option>
			<option '.($country_value == "GM" ? "selected" : "").' value="GM">Gambia</option>
			<option '.($country_value == "GE" ? "selected" : "").' value="GE">Georgia</option>
			<option '.($country_value == "DE" ? "selected" : "").' value="DE">Germany</option>
			<option '.($country_value == "GH" ? "selected" : "").' value="GH">Ghana</option>
			<option '.($country_value == "GI" ? "selected" : "").' value="GI">Gibraltar</option>
			<option '.($country_value == "GR" ? "selected" : "").' value="GR">Greece</option>
			<option '.($country_value == "GL" ? "selected" : "").' value="GL">Greenland</option>
			<option '.($country_value == "GD" ? "selected" : "").' value="GD">Grenada</option>
			<option '.($country_value == "GP" ? "selected" : "").' value="GP">Guadeloupe</option>
			<option '.($country_value == "GU" ? "selected" : "").' value="GU">Guam</option>
			<option '.($country_value == "GT" ? "selected" : "").' value="GT">Guatemala</option>
			<option '.($country_value == "GG" ? "selected" : "").' value="GG">Guernsey</option>
			<option '.($country_value == "GN" ? "selected" : "").' value="GN">Guinea</option>
			<option '.($country_value == "GW" ? "selected" : "").' value="GW">Guinea-Bissau</option>
			<option '.($country_value == "GY" ? "selected" : "").' value="GY">Guyana</option>
			<option '.($country_value == "HT" ? "selected" : "").' value="HT">Haiti</option>
			<option '.($country_value == "HM" ? "selected" : "").' value="HM">Heard Island and McDonald Islands</option>
			<option '.($country_value == "VA" ? "selected" : "").' value="VA">Holy See (Vatican City State)</option>
			<option '.($country_value == "HN" ? "selected" : "").' value="HN">Honduras</option>
			<option '.($country_value == "HK" ? "selected" : "").' value="HK">Hong Kong</option>
			<option '.($country_value == "HU" ? "selected" : "").' value="HU">Hungary</option>
			<option '.($country_value == "IS" ? "selected" : "").' value="IS">Iceland</option>
			<option '.($country_value == "IN" ? "selected" : "").' value="IN">India</option>
			<option '.($country_value == "ID" ? "selected" : "").' value="ID">Indonesia</option>
			<option '.($country_value == "IR" ? "selected" : "").' value="IR">Iran, Islamic Republic of</option>
			<option '.($country_value == "IQ" ? "selected" : "").' value="IQ">Iraq</option>
			<option '.($country_value == "IE" ? "selected" : "").' value="IE">Ireland</option>
			<option '.($country_value == "IM" ? "selected" : "").' value="IM">Isle of Man</option>
			<option '.($country_value == "IL" ? "selected" : "").' value="IL">Israel</option>
			<option '.($country_value == "IT" ? "selected" : "").' value="IT">Italy</option>
			<option '.($country_value == "JM" ? "selected" : "").' value="JM">Jamaica</option>
			<option '.($country_value == "JP" ? "selected" : "").' value="JP">Japan</option>
			<option '.($country_value == "JE" ? "selected" : "").' value="JE">Jersey</option>
			<option '.($country_value == "JO" ? "selected" : "").' value="JO">Jordan</option>
			<option '.($country_value == "KZ" ? "selected" : "").' value="KZ">Kazakhstan</option>
			<option '.($country_value == "KE" ? "selected" : "").' value="KE">Kenya</option>
			<option '.($country_value == "KI" ? "selected" : "").' value="KI">Kiribati</option>
			<option '.($country_value == "KP" ? "selected" : "").' value="KP">Korea, Democratic People\'s Republic of</option>
			<option '.($country_value == "KR" ? "selected" : "").' value="KR">Korea, Republic of</option>
			<option '.($country_value == "KW" ? "selected" : "").' value="KW">Kuwait</option>
			<option '.($country_value == "KG" ? "selected" : "").' value="KG">Kyrgyzstan</option>
			<option '.($country_value == "LA" ? "selected" : "").' value="LA">Lao People\'s Democratic Republic</option>
			<option '.($country_value == "LV" ? "selected" : "").' value="LV">Latvia</option>
			<option '.($country_value == "LB" ? "selected" : "").' value="LB">Lebanon</option>
			<option '.($country_value == "LS" ? "selected" : "").' value="LS">Lesotho</option>
			<option '.($country_value == "LR" ? "selected" : "").' value="LR">Liberia</option>
			<option '.($country_value == "LY" ? "selected" : "").' value="LY">Libya</option>
			<option '.($country_value == "LI" ? "selected" : "").' value="LI">Liechtenstein</option>
			<option '.($country_value == "LT" ? "selected" : "").' value="LT">Lithuania</option>
			<option '.($country_value == "LU" ? "selected" : "").' value="LU">Luxembourg</option>
			<option '.($country_value == "MO" ? "selected" : "").' value="MO">Macao</option>
			<option '.($country_value == "MK" ? "selected" : "").' value="MK">Macedonia, the former Yugoslav Republic of</option>
			<option '.($country_value == "MG" ? "selected" : "").' value="MG">Madagascar</option>
			<option '.($country_value == "MW" ? "selected" : "").' value="MW">Malawi</option>
			<option '.($country_value == "MY" ? "selected" : "").' value="MY">Malaysia</option>
			<option '.($country_value == "MV" ? "selected" : "").' value="MV">Maldives</option>
			<option '.($country_value == "ML" ? "selected" : "").' value="ML">Mali</option>
			<option '.($country_value == "MT" ? "selected" : "").' value="MT">Malta</option>
			<option '.($country_value == "MH" ? "selected" : "").' value="MH">Marshall Islands</option>
			<option '.($country_value == "MQ" ? "selected" : "").' value="MQ">Martinique</option>
			<option '.($country_value == "MR" ? "selected" : "").' value="MR">Mauritania</option>
			<option '.($country_value == "MU" ? "selected" : "").' value="MU">Mauritius</option>
			<option '.($country_value == "YT" ? "selected" : "").' value="YT">Mayotte</option>
			<option '.($country_value == "MX" ? "selected" : "").' value="MX">Mexico</option>
			<option '.($country_value == "FM" ? "selected" : "").' value="FM">Micronesia, Federated States of</option>
			<option '.($country_value == "MD" ? "selected" : "").' value="MD">Moldova, Republic of</option>
			<option '.($country_value == "MC" ? "selected" : "").' value="MC">Monaco</option>
			<option '.($country_value == "MN" ? "selected" : "").' value="MN">Mongolia</option>
			<option '.($country_value == "ME" ? "selected" : "").' value="ME">Montenegro</option>
			<option '.($country_value == "MS" ? "selected" : "").' value="MS">Montserrat</option>
			<option '.($country_value == "MA" ? "selected" : "").' value="MA">Morocco</option>
			<option '.($country_value == "MZ" ? "selected" : "").' value="MZ">Mozambique</option>
			<option '.($country_value == "MM" ? "selected" : "").' value="MM">Myanmar</option>
			<option '.($country_value == "NA" ? "selected" : "").' value="NA">Namibia</option>
			<option '.($country_value == "NR" ? "selected" : "").' value="NR">Nauru</option>
			<option '.($country_value == "NP" ? "selected" : "").' value="NP">Nepal</option>
			<option '.($country_value == "NL" ? "selected" : "").' value="NL">Netherlands</option>
			<option '.($country_value == "NC" ? "selected" : "").' value="NC">New Caledonia</option>
			<option '.($country_value == "NZ" ? "selected" : "").' value="NZ">New Zealand</option>
			<option '.($country_value == "NI" ? "selected" : "").' value="NI">Nicaragua</option>
			<option '.($country_value == "NE" ? "selected" : "").' value="NE">Niger</option>
			<option '.($country_value == "NG" ? "selected" : "").' value="NG">Nigeria</option>
			<option '.($country_value == "NU" ? "selected" : "").' value="NU">Niue</option>
			<option '.($country_value == "NF" ? "selected" : "").' value="NF">Norfolk Island</option>
			<option '.($country_value == "MP" ? "selected" : "").' value="MP">Northern Mariana Islands</option>
			<option '.($country_value == "NO" ? "selected" : "").' value="NO">Norway</option>
			<option '.($country_value == "OM" ? "selected" : "").' value="OM">Oman</option>
			<option '.($country_value == "PK" ? "selected" : "").' value="PK">Pakistan</option>
			<option '.($country_value == "PW" ? "selected" : "").' value="PW">Palau</option>
			<option '.($country_value == "PS" ? "selected" : "").' value="PS">Palestinian Territory, Occupied</option>
			<option '.($country_value == "PA" ? "selected" : "").' value="PA">Panama</option>
			<option '.($country_value == "PG" ? "selected" : "").' value="PG">Papua New Guinea</option>
			<option '.($country_value == "PY" ? "selected" : "").' value="PY">Paraguay</option>
			<option '.($country_value == "PE" ? "selected" : "").' value="PE">Peru</option>
			<option '.($country_value == "PH" ? "selected" : "").' value="PH">Philippines</option>
			<option '.($country_value == "PN" ? "selected" : "").' value="PN">Pitcairn</option>
			<option '.($country_value == "PL" ? "selected" : "").' value="PL">Poland</option>
			<option '.($country_value == "PT" ? "selected" : "").' value="PT">Portugal</option>
			<option '.($country_value == "PR" ? "selected" : "").' value="PR">Puerto Rico</option>
			<option '.($country_value == "QA" ? "selected" : "").' value="QA">Qatar</option>
			<option '.($country_value == "RE" ? "selected" : "").' value="RE">Réunion</option>
			<option '.($country_value == "RO" ? "selected" : "").' value="RO">Romania</option>
			<option '.($country_value == "RU" ? "selected" : "").' value="RU">Russian Federation</option>
			<option '.($country_value == "RW" ? "selected" : "").' value="RW">Rwanda</option>
			<option '.($country_value == "BL" ? "selected" : "").' value="BL">Saint Barthélemy</option>
			<option '.($country_value == "SH" ? "selected" : "").' value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
			<option '.($country_value == "KN" ? "selected" : "").' value="KN">Saint Kitts and Nevis</option>
			<option '.($country_value == "LC" ? "selected" : "").' value="LC">Saint Lucia</option>
			<option '.($country_value == "MF" ? "selected" : "").' value="MF">Saint Martin (French part)</option>
			<option '.($country_value == "PM" ? "selected" : "").' value="PM">Saint Pierre and Miquelon</option>
			<option '.($country_value == "VC" ? "selected" : "").' value="VC">Saint Vincent and the Grenadines</option>
			<option '.($country_value == "WS" ? "selected" : "").' value="WS">Samoa</option>
			<option '.($country_value == "SM" ? "selected" : "").' value="SM">San Marino</option>
			<option '.($country_value == "ST" ? "selected" : "").' value="ST">Sao Tome and Principe</option>
			<option '.($country_value == "SA" ? "selected" : "").' value="SA">Saudi Arabia</option>
			<option '.($country_value == "SN" ? "selected" : "").' value="SN">Senegal</option>
			<option '.($country_value == "RS" ? "selected" : "").' value="RS">Serbia</option>
			<option '.($country_value == "SC" ? "selected" : "").' value="SC">Seychelles</option>
			<option '.($country_value == "SL" ? "selected" : "").' value="SL">Sierra Leone</option>
			<option '.($country_value == "SG" ? "selected" : "").' value="SG">Singapore</option>
			<option '.($country_value == "SX" ? "selected" : "").' value="SX">Sint Maarten (Dutch part)</option>
			<option '.($country_value == "SK" ? "selected" : "").' value="SK">Slovakia</option>
			<option '.($country_value == "SI" ? "selected" : "").' value="SI">Slovenia</option>
			<option '.($country_value == "SB" ? "selected" : "").' value="SB">Solomon Islands</option>
			<option '.($country_value == "SO" ? "selected" : "").' value="SO">Somalia</option>
			<option '.($country_value == "ZA" ? "selected" : "").' value="ZA">South Africa</option>
			<option '.($country_value == "GS" ? "selected" : "").' value="GS">South Georgia and the South Sandwich Islands</option>
			<option '.($country_value == "SS" ? "selected" : "").' value="SS">South Sudan</option>
			<option '.($country_value == "ES" ? "selected" : "").' value="ES">Spain</option>
			<option '.($country_value == "LK" ? "selected" : "").' value="LK">Sri Lanka</option>
			<option '.($country_value == "SD" ? "selected" : "").' value="SD">Sudan</option>
			<option '.($country_value == "SR" ? "selected" : "").' value="SR">Suriname</option>
			<option '.($country_value == "SJ" ? "selected" : "").' value="SJ">Svalbard and Jan Mayen</option>
			<option '.($country_value == "SZ" ? "selected" : "").' value="SZ">Swaziland</option>
			<option '.($country_value == "SE" ? "selected" : "").' value="SE">Sweden</option>
			<option '.($country_value == "CH" ? "selected" : "").' value="CH">Switzerland</option>
			<option '.($country_value == "SY" ? "selected" : "").' value="SY">Syrian Arab Republic</option>
			<option '.($country_value == "TW" ? "selected" : "").' value="TW">Taiwan, Province of China</option>
			<option '.($country_value == "TJ" ? "selected" : "").' value="TJ">Tajikistan</option>
			<option '.($country_value == "TZ" ? "selected" : "").' value="TZ">Tanzania, United Republic of</option>
			<option '.($country_value == "TH" ? "selected" : "").' value="TH">Thailand</option>
			<option '.($country_value == "TL" ? "selected" : "").' value="TL">Timor-Leste</option>
			<option '.($country_value == "TG" ? "selected" : "").' value="TG">Togo</option>
			<option '.($country_value == "TK" ? "selected" : "").' value="TK">Tokelau</option>
			<option '.($country_value == "TO" ? "selected" : "").' value="TO">Tonga</option>
			<option '.($country_value == "TT" ? "selected" : "").' value="TT">Trinidad and Tobago</option>
			<option '.($country_value == "TN" ? "selected" : "").' value="TN">Tunisia</option>
			<option '.($country_value == "TR" ? "selected" : "").' value="TR">Turkey</option>
			<option '.($country_value == "TM" ? "selected" : "").' value="TM">Turkmenistan</option>
			<option '.($country_value == "TC" ? "selected" : "").' value="TC">Turks and Caicos Islands</option>
			<option '.($country_value == "TV" ? "selected" : "").' value="TV">Tuvalu</option>
			<option '.($country_value == "UG" ? "selected" : "").' value="UG">Uganda</option>
			<option '.($country_value == "UA" ? "selected" : "").' value="UA">Ukraine</option>
			<option '.($country_value == "AE" ? "selected" : "").' value="AE">United Arab Emirates</option>
			<option '.($country_value == "GB" ? "selected" : "").' value="GB">United Kingdom</option>
			<option '.($country_value == "US" ? "selected" : "").' value="US">United States</option>
			<option '.($country_value == "UM" ? "selected" : "").' value="UM">United States Minor Outlying Islands</option>
			<option '.($country_value == "UY" ? "selected" : "").' value="UY">Uruguay</option>
			<option '.($country_value == "UZ" ? "selected" : "").' value="UZ">Uzbekistan</option>
			<option '.($country_value == "VU" ? "selected" : "").' value="VU">Vanuatu</option>
			<option '.($country_value == "VE" ? "selected" : "").' value="VE">Venezuela, Bolivarian Republic of</option>
			<option '.($country_value == "VN" ? "selected" : "").' value="VN">Viet Nam</option>
			<option '.($country_value == "VG" ? "selected" : "").' value="VG">Virgin Islands, British</option>
			<option '.($country_value == "VI" ? "selected" : "").' value="VI">Virgin Islands, U.S.</option>
			<option '.($country_value == "WF" ? "selected" : "").' value="WF">Wallis and Futuna</option>
			<option '.($country_value == "EH" ? "selected" : "").' value="EH">Western Sahara</option>
			<option '.($country_value == "YE" ? "selected" : "").' value="YE">Yemen</option>
			<option '.($country_value == "ZM" ? "selected" : "").' value="ZM">Zambia</option>
			<option '.($country_value == "ZW" ? "selected" : "").' value="ZW">Zimbabwe</option>';

			return $html;

    }

?>
