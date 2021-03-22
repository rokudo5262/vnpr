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

class NxPro_Google_Service_AnalyticsReporting_DynamicSegment extends NxPro_Google_Model
{
  public $name;
  protected $sessionSegmentType = 'NxPro_Google_Service_AnalyticsReporting_SegmentDefinition';
  protected $sessionSegmentDataType = '';
  protected $userSegmentType = 'NxPro_Google_Service_AnalyticsReporting_SegmentDefinition';
  protected $userSegmentDataType = '';

  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_SegmentDefinition
   */
  public function setSessionSegment(NxPro_Google_Service_AnalyticsReporting_SegmentDefinition $sessionSegment)
  {
    $this->sessionSegment = $sessionSegment;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_SegmentDefinition
   */
  public function getSessionSegment()
  {
    return $this->sessionSegment;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_SegmentDefinition
   */
  public function setUserSegment(NxPro_Google_Service_AnalyticsReporting_SegmentDefinition $userSegment)
  {
    $this->userSegment = $userSegment;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_SegmentDefinition
   */
  public function getUserSegment()
  {
    return $this->userSegment;
  }
}
