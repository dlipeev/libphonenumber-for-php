<?php

namespace com\google\i18n\phonenumbers;

require_once dirname(__FILE__) . '/../PhoneNumberUtil.php';
require_once dirname(__FILE__) . '/../RegionCode.php';
require_once dirname(__FILE__) . '/../PhoneNumber.php';

/**
 * Test class for PhoneNumberUtil.
 * Generated by PHPUnit on 2012-02-12 at 00:30:35.
 */
class PhoneNumberUtilTest extends \PHPUnit_Framework_TestCase {

	private static $bsNumber = NULL;

	/**
	 * @var PhoneNumberUtil
	 */
	protected $phoneUtil;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->phoneUtil = PhoneNumberUtil::getInstance();
		self::$bsNumber = new PhoneNumber();
		self::$bsNumber->setCountryCode(1)->setNationalNumber(2423651234);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 * @covers com\google\i18n\phonenumbers\PhoneNumberUtil::isViablePhoneNumber
	 * @todo Implement testIsViablePhoneNumber().
	 */
	public function testIsViablePhoneNumber() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers com\google\i18n\phonenumbers\PhoneNumberUtil::normalize
	 * @todo Implement testNormalize().
	 */
	public function testNormalize() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers com\google\i18n\phonenumbers\PhoneNumberUtil::normalizeDigitsOnly
	 * @todo Implement testNormalizeDigitsOnly().
	 */
	public function testNormalizeDigitsOnly() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers com\google\i18n\phonenumbers\PhoneNumberUtil::isValidNumberForRegion
	 * @todo Implement testIsValidNumberForRegion().
	 */
	public function testIsValidNumberForRegion() {
		// This number is valid for the Bahamas, but is not a valid US number.
		$this->assertTrue($this->phoneUtil->isValidNumber(self::$bsNumber));
		$this->assertTrue($this->phoneUtil->isValidNumberForRegion(self::$bsNumber, RegionCode::BS));
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion(self::$bsNumber, RegionCode::US));
		$bsInvalidNumber = new PhoneNumber();
		$bsInvalidNumber->setCountryCode(1)->setNationalNumber(2421232345);
		// This number is no longer valid.
		$this->assertFalse($this->phoneUtil->isValidNumber($bsInvalidNumber));

		// La Mayotte and Reunion use 'leadingDigits' to differentiate them.
		$reNumber = new PhoneNumber();
		$reNumber->setCountryCode(262)->setNationalNumber(262123456);
		$this->assertTrue($this->phoneUtil->isValidNumber($reNumber));
		$this->assertTrue($this->phoneUtil->isValidNumberForRegion($reNumber, RegionCode::RE));
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion($reNumber, RegionCode::YT));
		// Now change the number to be a number for La Mayotte.
		$reNumber->setNationalNumber(269601234);
		$this->assertTrue($this->phoneUtil->isValidNumberForRegion($reNumber, RegionCode::YT));
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion($reNumber, RegionCode::RE));
		// This number is no longer valid for La Reunion.
		$reNumber->setNationalNumber(269123456);
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion($reNumber, RegionCode::YT));
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion($reNumber, RegionCode::RE));
		$this->assertFalse($this->phoneUtil->isValidNumber($reNumber));
		// However, it should be recognised as from La Mayotte, since it is valid for this region.
		$this->assertEquals(RegionCode::YT, $this->phoneUtil->getRegionCodeForNumber($reNumber));
		// This number is valid in both places.
		$reNumber->setNationalNumber(800123456);
		$this->assertTrue($this->phoneUtil->isValidNumberForRegion($reNumber, RegionCode::YT));
		$this->assertTrue($this->phoneUtil->isValidNumberForRegion($reNumber, RegionCode::RE));
		$this->assertTrue($this->phoneUtil->isValidNumberForRegion(INTERNATIONAL_TOLL_FREE, RegionCode::UN001));
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion(INTERNATIONAL_TOLL_FREE, RegionCode::US));
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion(INTERNATIONAL_TOLL_FREE, RegionCode::ZZ));

		$invalidNumber = new PhoneNumber();
		// Invalid country calling codes.
		$invalidNumber->setCountryCode(3923)->setNationalNumber(2366);
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion(invalidNumber, RegionCode::ZZ));
		$invalidNumber->setCountryCode(3923)->setNationalNumber(2366);
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion(invalidNumber, RegionCode::UN001));
		$invalidNumber->setCountryCode(0)->setNationalNumber(2366);
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion(invalidNumber, RegionCode::UN001));
		$invalidNumber->setCountryCode(0);
		$this->assertFalse($this->phoneUtil->isValidNumberForRegion(invalidNumber, RegionCode::ZZ));
	}

}