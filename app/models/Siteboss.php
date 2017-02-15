<?php

use Phalcon\Mvc\Model;

class Siteboss extends Model
{

public $id;
public $project_id;
public $SiteName;
public $ProjectCode;
public $VendorCode;
public $VendorPonum;
public $VendorInvoicenum;
public $SiteID;
public $EquipmentRelease;
public $Switch;
public $CellNumber;
public $Latitude;
public $Longitude;
public $Address;
public $City;
public $State;
public $ZIP;
public $County;
public $CellTech;
public $PhoneNumber;
public $Email;
public $SiteBossIP;
public $Subnet;
public $Gateway;
public $RouterPort;
public $AccessDirections;
public $SiteNotes;
public $PowerPlant;
public $PowerPlantMonitored;
public $PowerPlantIP;
public $PowerPlantComment;
public $HVAC;
public $HVACMonitored;
public $HVACIP;
public $HVACComment;
public $ATSType;
public $ATSComment;
public $GeneratorRunSchedule;
public $GenType;
public $GenModel;
public $FuelType;
public $FuelGaugeType;
public $FuseorBreaker;
public $CompletionDate;
public $CompletionName;

	public function setWithArray( array $theArray ) {
        //$this->id = array_key_exists('id', $theArray) ? trim($theArray['id']) : null;
		$this->project_id = array_key_exists('project_id', $theArray) ? trim($theArray['project_id']) : null;
		$this->SiteName = array_key_exists('SiteName', $theArray) ? trim($theArray['SiteName']) : null;
		$this->ProjectCode = array_key_exists('ProjectCode', $theArray) ? trim($theArray['ProjectCode']) : null;
		$this->VendorCode = array_key_exists('VendorCode', $theArray) ? trim($theArray['VendorCode']) : null;
		$this->VendorPonum = array_key_exists('VendorPonum', $theArray) ? trim($theArray['VendorPonum']) : null;
		$this->VendorInvoicenum = array_key_exists('VendorInvoicenum', $theArray) ? trim($theArray['VendorInvoicenum']) : null;
		$this->SiteID = array_key_exists('SiteID', $theArray) ? trim($theArray['SiteID']) : null;
		$this->EquipmentRelease = array_key_exists('EquipmentRelease', $theArray) ? trim($theArray['EquipmentRelease']) : null;
		$this->Switch = array_key_exists('Switch', $theArray) ? trim($theArray['Switch']) : null;
		$this->CellNumber = array_key_exists('CellNumber', $theArray) ? trim($theArray['CellNumber']) : null;
		$this->Latitude = array_key_exists('Latitude', $theArray) ? trim($theArray['Latitude']) : null;
		$this->Longitude = array_key_exists('Longitude', $theArray) ? trim($theArray['Longitude']) : null;
		$this->Address = array_key_exists('Address', $theArray) ? trim($theArray['Address']) : null;
		$this->City = array_key_exists('City', $theArray) ? trim($theArray['City']) : null;
		$this->State = array_key_exists('State', $theArray) ? trim($theArray['State']) : null;
		$this->ZIP = array_key_exists('ZIP', $theArray) ? trim($theArray['ZIP']) : null;
		$this->County = array_key_exists('County', $theArray) ? trim($theArray['County']) : null;
		$this->CellTech = array_key_exists('CellTech', $theArray) ? trim($theArray['CellTech']) : null;
		$this->PhoneNumber = array_key_exists('PhoneNumber', $theArray) ? trim($theArray['PhoneNumber']) : null;
		$this->Email = array_key_exists('Email', $theArray) ? trim($theArray['Email']) : null;
		$this->SiteBossIP = array_key_exists('SiteBossIP', $theArray) ? trim($theArray['SiteBossIP']) : null;
		$this->Subnet = array_key_exists('Subnet', $theArray) ? trim($theArray['Subnet']) : null;
		$this->Gateway = array_key_exists('Gateway', $theArray) ? trim($theArray['Gateway']) : null;
		$this->RouterPort = array_key_exists('RouterPort', $theArray) ? trim($theArray['RouterPort']) : null;
		$this->AccessDirections = array_key_exists('AccessDirections', $theArray) ? trim($theArray['AccessDirections']) : null;
		$this->SiteNotes = array_key_exists('SiteNotes', $theArray) ? trim($theArray['SiteNotes']) : null;
		$this->PowerPlant = array_key_exists('PowerPlant', $theArray) ? trim($theArray['PowerPlant']) : null;
		$this->PowerPlantMonitored = array_key_exists('PowerPlantMonitored', $theArray) ? trim($theArray['PowerPlantMonitored']) : null;
		$this->PowerPlantIP = array_key_exists('PowerPlantIP', $theArray) ? trim($theArray['PowerPlantIP']) : null;
		$this->PowerPlantComment = array_key_exists('PowerPlantComment', $theArray) ? trim($theArray['PowerPlantComment']) : null;
		$this->HVAC = array_key_exists('HVAC', $theArray) ? trim($theArray['HVAC']) : null;
		$this->HVACMonitored = array_key_exists('HVACMonitored', $theArray) ? trim($theArray['HVACMonitored']) : null;
		$this->HVACIP = array_key_exists('HVACIP', $theArray) ? trim($theArray['HVACIP']) : null;
		$this->HVACComment = array_key_exists('HVACComment', $theArray) ? trim($theArray['HVACComment']) : null;
		$this->ATSType = array_key_exists('ATSType', $theArray) ? trim($theArray['ATSType']) : null;
		$this->ATSComment = array_key_exists('ATSComment', $theArray) ? trim($theArray['ATSComment']) : null;
		$this->GeneratorRunSchedule = array_key_exists('GeneratorRunSchedule', $theArray) ? trim($theArray['GeneratorRunSchedule']) : null;
		$this->GenType = array_key_exists('GenType', $theArray) ? trim($theArray['GenType']) : null;
		$this->GenModel = array_key_exists('GenModel', $theArray) ? trim($theArray['GenModel']) : null;
		$this->FuelType = array_key_exists('FuelType', $theArray) ? trim($theArray['FuelType']) : null;
		$this->FuelGaugeType = array_key_exists('FuelGaugeType', $theArray) ? trim($theArray['FuelGaugeType']) : null;
		$this->FuseorBreaker = array_key_exists('FuseorBreaker', $theArray) ? trim($theArray['FuseorBreaker']) : null;
		$this->CompletionDate = array_key_exists('CompletionDate', $theArray) ? trim($theArray['CompletionDate']) : null;
		$this->CompletionName = array_key_exists('CompletionName', $theArray) ? trim($theArray['CompletionName']) : null;
    }
    /*
    public function onConstruct($theArray)
    {
        if(!empty($theArray))
        {
			$id = array_key_exists('id', $theArray[$id]) ? $theArray[$id] : null;
			$project_id = array_key_exists('project_id', $theArray[$project_id]) ? $theArray[$project_id] : null;
			$SiteName = array_key_exists('SiteName', $theArray[$SiteName]) ? $theArray[$SiteName] : null;
			$ProjectCode = array_key_exists('ProjectCode', $theArray[$ProjectCode]) ? $theArray[$ProjectCode] : null;
			$VendorCode = array_key_exists('VendorCode', $theArray[$VendorCode]) ? $theArray[$VendorCode] : null;
			$VendorPonum = array_key_exists('VendorPonum', $theArray[$VendorPonum]) ? $theArray[$VendorPonum] : null;
			$VendorInvoicenum = array_key_exists('VendorInvoicenum', $theArray[$VendorInvoicenum]) ? $theArray[$VendorInvoicenum] : null;
			$SiteID = array_key_exists('SiteID', $theArray[$SiteID]) ? $theArray[$SiteID] : null;
			$EquipmentRelease = array_key_exists('EquipmentRelease', $theArray[$EquipmentRelease]) ? $theArray[$EquipmentRelease] : null;
			$Switch = array_key_exists('Switch', $theArray[$Switch]) ? $theArray[$Switch] : null;
			$CellNumber = array_key_exists('CellNumber', $theArray[$CellNumber]) ? $theArray[$CellNumber] : null;
			$Latitude = array_key_exists('Latitude', $theArray[$Latitude]) ? $theArray[$Latitude] : null;
			$Longitude = array_key_exists('Longitude', $theArray[$Longitude]) ? $theArray[$Longitude] : null;
			$Address = array_key_exists('Address', $theArray[$Address]) ? $theArray[$Address] : null;
			$City = array_key_exists('City', $theArray[$City]) ? $theArray[$City] : null;
			$State = array_key_exists('State', $theArray[$State]) ? $theArray[$State] : null;
			$ZIP = array_key_exists('ZIP', $theArray[$ZIP]) ? $theArray[$ZIP] : null;
			$County = array_key_exists('County', $theArray[$County]) ? $theArray[$County] : null;
			$CellTech = array_key_exists('CellTech', $theArray[$CellTech]) ? $theArray[$CellTech] : null;
			$PhoneNumber = array_key_exists('PhoneNumber', $theArray[$PhoneNumber]) ? $theArray[$PhoneNumber] : null;
			$Email = array_key_exists('Email', $theArray[$Email]) ? $theArray[$Email] : null;
			$SiteBossIP = array_key_exists('SiteBossIP', $theArray[$SiteBossIP]) ? $theArray[$SiteBossIP] : null;
			$Subnet = array_key_exists('Subnet', $theArray[$Subnet]) ? $theArray[$Subnet] : null;
			$Gateway = array_key_exists('Gateway', $theArray[$Gateway]) ? $theArray[$Gateway] : null;
			$RouterPort = array_key_exists('RouterPort', $theArray[$RouterPort]) ? $theArray[$RouterPort] : null;
			$AccessDirections = array_key_exists('AccessDirections', $theArray[$AccessDirections]) ? $theArray[$AccessDirections] : null;
			$SiteNotes = array_key_exists('SiteNotes', $theArray[$SiteNotes]) ? $theArray[$SiteNotes] : null;
			$PowerPlant = array_key_exists('PowerPlant', $theArray[$PowerPlant]) ? $theArray[$PowerPlant] : null;
			$PowerPlantMonitored = array_key_exists('PowerPlantMonitored', $theArray[$PowerPlantMonitored]) ? $theArray[$PowerPlantMonitored] : null;
			$PowerPlantIP = array_key_exists('PowerPlantIP', $theArray[$PowerPlantIP]) ? $theArray[$PowerPlantIP] : null;
			$PowerPlantComment = array_key_exists('PowerPlantComment', $theArray[$PowerPlantComment]) ? $theArray[$PowerPlantComment] : null;
			$HVAC = array_key_exists('HVAC', $theArray[$HVAC]) ? $theArray[$HVAC] : null;
			$HVACMonitored = array_key_exists('HVACMonitored', $theArray[$HVACMonitored]) ? $theArray[$HVACMonitored] : null;
			$HVACIP = array_key_exists('HVACIP', $theArray[$HVACIP]) ? $theArray[$HVACIP] : null;
			$HVACComment = array_key_exists('HVACComment', $theArray[$HVACComment]) ? $theArray[$HVACComment] : null;
			$ATSType = array_key_exists('ATSType', $theArray[$ATSType]) ? $theArray[$ATSType] : null;
			$ATSComment = array_key_exists('ATSComment', $theArray[$ATSComment]) ? $theArray[$ATSComment] : null;
			$GeneratorRunSchedule = array_key_exists('GeneratorRunSchedule', $theArray[$GeneratorRunSchedule]) ? $theArray[$GeneratorRunSchedule] : null;
			$GenType = array_key_exists('GenType', $theArray[$GenType]) ? $theArray[$GenType] : null;
			$GenModel = array_key_exists('GenModel', $theArray[$GenModel]) ? $theArray[$GenModel] : null;
			$FuelType = array_key_exists('FuelType', $theArray[$FuelType]) ? $theArray[$FuelType] : null;
			$FuelGaugeType = array_key_exists('FuelGaugeType', $theArray[$FuelGaugeType]) ? $theArray[$FuelGaugeType] : null;
			$FuseorBreaker = array_key_exists('FuseorBreaker', $theArray[$FuseorBreaker]) ? $theArray[$FuseorBreaker] : null;
			$CompletionDate = array_key_exists('CompletionDate', $theArray[$CompletionDate]) ? $theArray[$CompletionDate] : null;
			$CompletionName = array_key_exists('CompletionName', $theArray[$CompletionName]) ? $theArray[$CompletionName] : null;
		}
    }
    */ 

}
