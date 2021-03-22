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

class NxPro_Google_Service_AnalyticsReporting_Activity extends NxPro_Google_Collection
{
  protected $collection_key = 'customDimension';
  public $activityTime;
  public $activityType;
  protected $appviewType = 'NxPro_Google_Service_AnalyticsReporting_ScreenviewData';
  protected $appviewDataType = '';
  public $campaign;
  public $channelGrouping;
  protected $customDimensionType = 'NxPro_Google_Service_AnalyticsReporting_CustomDimension';
  protected $customDimensionDataType = 'array';
  protected $ecommerceType = 'NxPro_Google_Service_AnalyticsReporting_EcommerceData';
  protected $ecommerceDataType = '';
  protected $eventType = 'NxPro_Google_Service_AnalyticsReporting_EventData';
  protected $eventDataType = '';
  protected $goalsType = 'NxPro_Google_Service_AnalyticsReporting_GoalSetData';
  protected $goalsDataType = '';
  public $hostname;
  public $keyword;
  public $landingPagePath;
  public $medium;
  protected $pageviewType = 'NxPro_Google_Service_AnalyticsReporting_PageviewData';
  protected $pageviewDataType = '';
  public $source;

  public function setActivityTime($activityTime)
  {
    $this->activityTime = $activityTime;
  }
  public function getActivityTime()
  {
    return $this->activityTime;
  }
  public function setActivityType($activityType)
  {
    $this->activityType = $activityType;
  }
  public function getActivityType()
  {
    return $this->activityType;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_ScreenviewData
   */
  public function setAppview(NxPro_Google_Service_AnalyticsReporting_ScreenviewData $appview)
  {
    $this->appview = $appview;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_ScreenviewData
   */
  public function getAppview()
  {
    return $this->appview;
  }
  public function setCampaign($campaign)
  {
    $this->campaign = $campaign;
  }
  public function getCampaign()
  {
    return $this->campaign;
  }
  public function setChannelGrouping($channelGrouping)
  {
    $this->channelGrouping = $channelGrouping;
  }
  public function getChannelGrouping()
  {
    return $this->channelGrouping;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_CustomDimension
   */
  public function setCustomDimension($customDimension)
  {
    $this->customDimension = $customDimension;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_CustomDimension
   */
  public function getCustomDimension()
  {
    return $this->customDimension;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_EcommerceData
   */
  public function setEcommerce(NxPro_Google_Service_AnalyticsReporting_EcommerceData $ecommerce)
  {
    $this->ecommerce = $ecommerce;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_EcommerceData
   */
  public function getEcommerce()
  {
    return $this->ecommerce;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_EventData
   */
  public function setEvent(NxPro_Google_Service_AnalyticsReporting_EventData $event)
  {
    $this->event = $event;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_EventData
   */
  public function getEvent()
  {
    return $this->event;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_GoalSetData
   */
  public function setGoals(NxPro_Google_Service_AnalyticsReporting_GoalSetData $goals)
  {
    $this->goals = $goals;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_GoalSetData
   */
  public function getGoals()
  {
    return $this->goals;
  }
  public function setHostname($hostname)
  {
    $this->hostname = $hostname;
  }
  public function getHostname()
  {
    return $this->hostname;
  }
  public function setKeyword($keyword)
  {
    $this->keyword = $keyword;
  }
  public function getKeyword()
  {
    return $this->keyword;
  }
  public function setLandingPagePath($landingPagePath)
  {
    $this->landingPagePath = $landingPagePath;
  }
  public function getLandingPagePath()
  {
    return $this->landingPagePath;
  }
  public function setMedium($medium)
  {
    $this->medium = $medium;
  }
  public function getMedium()
  {
    return $this->medium;
  }
  /**
   * @param NxPro_Google_Service_AnalyticsReporting_PageviewData
   */
  public function setPageview(NxPro_Google_Service_AnalyticsReporting_PageviewData $pageview)
  {
    $this->pageview = $pageview;
  }
  /**
   * @return NxPro_Google_Service_AnalyticsReporting_PageviewData
   */
  public function getPageview()
  {
    return $this->pageview;
  }
  public function setSource($source)
  {
    $this->source = $source;
  }
  public function getSource()
  {
    return $this->source;
  }
}
