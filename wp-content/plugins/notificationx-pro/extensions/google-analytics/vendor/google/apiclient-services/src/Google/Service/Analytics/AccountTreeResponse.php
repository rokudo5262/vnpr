<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

class NxPro_Google_Service_Analytics_AccountTreeResponse extends NxPro_Google_Model
{
  protected $accountType = 'NxPro_Google_Service_Analytics_Account';
  protected $accountDataType = '';
  public $kind;
  protected $profileType = 'NxPro_Google_Service_Analytics_Profile';
  protected $profileDataType = '';
  protected $webpropertyType = 'NxPro_Google_Service_Analytics_Webproperty';
  protected $webpropertyDataType = '';

  /**
   * @param NxPro_Google_Service_Analytics_Account
   */
  public function setAccount(NxPro_Google_Service_Analytics_Account $account)
  {
    $this->account = $account;
  }
  /**
   * @return NxPro_Google_Service_Analytics_Account
   */
  public function getAccount()
  {
    return $this->account;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  /**
   * @param NxPro_Google_Service_Analytics_Profile
   */
  public function setProfile(NxPro_Google_Service_Analytics_Profile $profile)
  {
    $this->profile = $profile;
  }
  /**
   * @return NxPro_Google_Service_Analytics_Profile
   */
  public function getProfile()
  {
    return $this->profile;
  }
  /**
   * @param NxPro_Google_Service_Analytics_Webproperty
   */
  public function setWebproperty(NxPro_Google_Service_Analytics_Webproperty $webproperty)
  {
    $this->webproperty = $webproperty;
  }
  /**
   * @return NxPro_Google_Service_Analytics_Webproperty
   */
  public function getWebproperty()
  {
    return $this->webproperty;
  }
}
