<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.8
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/*
 * Configure paths required to find CakePHP + general filepath constants
 */
require __DIR__ . '/paths.php';

/*
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Console\ConsoleErrorHandler;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorHandler;
use Cake\Http\ServerRequest;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;
use Cake\Utility\Inflector;
use Cake\Utility\Security;

/**
 * Uncomment block of code below if you want to use `.env` file during development.
 * You should copy `config/.env.default to `config/.env` and set/modify the
 * variables as required.
 *
 * It is HIGHLY discouraged to use a .env file in production, due to security risks
 * and decreased performance on each request. The purpose of the .env file is to emulate
 * the presence of the environment variables like they would be present in production.
 */
// if (!env('APP_NAME') && file_exists(CONFIG . '.env')) {
//     $dotenv = new \josegonzalez\Dotenv\Loader([CONFIG . '.env']);
//     $dotenv->parse()
//         ->putenv()
//         ->toEnv()
//         ->toServer();
// }

/*
 * Read configuration file and inject configuration into various
 * CakePHP classes.
 *
 * By default there is only one configuration file. It is often a good
 * idea to create multiple configuration files, and separate the configuration
 * that changes from configuration that does not. This makes deployment simpler.
 */
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

/*
 * Load an environment local configuration file.
 * You can use a file like app_local.php to provide local overrides to your
 * shared configuration.
 */
//Configure::load('app_local', 'default');

/*
 * When debug = true the metadata cache should only last
 * for a short time.
 */
if (Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+2 minutes');
    Configure::write('Cache._cake_core_.duration', '+2 minutes');
    // disable router cache during development
    Configure::write('Cache._cake_routes_.duration', '+2 seconds');
}

/*
 * Set the default server timezone. Using UTC makes time calculations / conversions easier.
 * Check http://php.net/manual/en/timezones.php for list of valid timezone strings.
 */
date_default_timezone_set(Configure::read('App.defaultTimezone'));

/*
 * Configure the mbstring extension to use the correct encoding.
 */
mb_internal_encoding(Configure::read('App.encoding'));

/*
 * Set the default locale. This controls how dates, number and currency is
 * formatted and sets the default language to use for translations.
 */
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

/*
 * Register application error and exception handlers.
 */
$isCli = PHP_SAPI === 'cli';
if ($isCli) {
    (new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
    (new ErrorHandler(Configure::read('Error')))->register();
}

/*
 * Include the CLI bootstrap overrides.
 */
if ($isCli) {
    require __DIR__ . '/bootstrap_cli.php';
}

/*
 * Set the full base URL.
 * This URL is used as the base of all absolute links.
 *
 * If you define fullBaseUrl in your config file you can remove this.
 */
if (!Configure::read('App.fullBaseUrl')) {
    $s = null;
    if (env('HTTPS')) {
        $s = 's';
    }

    $httpHost = env('HTTP_HOST');
    if (isset($httpHost)) {
        Configure::write('App.fullBaseUrl', 'http' . $s . '://' . $httpHost);
    }
    unset($httpHost, $s);
}

Cache::setConfig(Configure::consume('Cache'));
ConnectionManager::setConfig(Configure::consume('Datasources'));
TransportFactory::setConfig(Configure::consume('EmailTransport'));
Email::setConfig(Configure::consume('Email'));
Log::setConfig(Configure::consume('Log'));
Security::setSalt(Configure::consume('Security.salt'));

/*
 * The default crypto extension in 3.0 is OpenSSL.
 * If you are migrating from 2.x uncomment this code to
 * use a more compatible Mcrypt based implementation
 */
//Security::engine(new \Cake\Utility\Crypto\Mcrypt());

/*
 * Setup detectors for mobile and tablet.
 */
ServerRequest::addDetector('mobile', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isMobile();
});
ServerRequest::addDetector('tablet', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isTablet();
});

/*
 * Enable immutable time objects in the ORM.
 *
 * You can enable default locale format parsing by adding calls
 * to `useLocaleParser()`. This enables the automatic conversion of
 * locale specific date formats. For details see
 * @link https://book.cakephp.org/3.0/en/core-libraries/internationalization-and-localization.html#parsing-localized-datetime-data
 */
Type::build('time')
    ->useImmutable();
Type::build('date')
    ->useImmutable();
Type::build('datetime')
    ->useImmutable();
Type::build('timestamp')
    ->useImmutable();

/*
 * Custom Inflector rules, can be set to correctly pluralize or singularize
 * table, model, controller names or whatever other string is passed to the
 * inflection functions.
 */
//Inflector::rules('plural', ['/^(inflect)or$/i' => '\1ables']);
//Inflector::rules('irregular', ['red' => 'redlings']);
//Inflector::rules('uninflected', ['dontinflectme']);
//Inflector::rules('transliteration', ['/å/' => 'aa']);
Configure::write('DebugKit.forceEnable', false);
/**
 * Writes the employee
 */
Configure::write('EMPLOYEES', [
    'EMPLOYEE_STATUS' => [
        '1' => 'Licensed/Regular',
        '2' => 'Unlicensed'
    ],
    'ROLES_LIST' => [
        '1' => 'Admin',
        '2' => 'Principal',
        '3' => 'Teacher',
        '4' => 'Head Teacher'
    ],
    'ROLES' => [
        'Admin' => 1,
        'Principal' => 2,
        'Teacher' => 3,
        'HeadTeacher' => 4
    ],
    'GENDER' => [
        'Male' => 1,
        'Female' => 2
    ],
    'ALS' => [
        'True' => 1,
        'False' => 2
    ],
    'CIVIL_STATUS' => [
        'Single',
        'Married',
        'Widowed',
        'Separated',
        'Others'
    ],
    'CITIZENSHIP' => [
        '1' => 'Filipino',
        '2' => 'Dual Citizenship'
    ],
    'CITIZENSHIP_DUAL' => [
        '1' => 'By birth',
        '2' => 'By naturalization'
    ]
]);

/**
 * Writes the leaves
 */
Configure::write('LEAVES', [
    'STATUS' => [
        'ForApproval' => 1,
        'Approved' => 2,
        'Cancelled' => 3,
        'Disapproved' => 4,
        'ApprovedByHeadTeacher' => 5,
        'DisapprovedByHeadTeacher' => 6,
        'ApprovedByAdmin' => 7,
        'DisapprovedByAdmin' => 8
    ],
    'MATERNITY_ID' => 4,
    'PATERNITY_ID' => 5,
    'NON_ALS_ID' => 6,
    'SERVICE_CREDIT' => 7,
    'BALANCE' => [
        'Combo' => 15,
        'Vacation' => 15,
        'Sick' => 15,
        'Paternity' => 7,
        'Maternity' => 103,
        'ServiceCredit' => 0
    ],
    'TYPE' => [
        'Vacation' => 1,
        'Sick' => 2,
        'ToSeekEmployment' => 3,
        'Maternity' => 4,
        'Paternity' => 5,
        'Combo' => 6,
        'ServiceCredit' => 7
    ]
]);

/**
 * Writes the system configuration
 */
Configure::write('SYSTEM_CONFIG', [
    'Name' => 1,
    'Image' => 2
]);

/**
 * Writes the list of countries
 */
Configure::write('COUNTRIES', [
    'Afghanistan',
    'Albania',
    'Algeria',
    'Andorra',
    'Angola',
    'Antigua and Barbuda',
    'Argentina',
    'Armenia',
    'Australia',
    'Austria',
    'Azerbaijan',
    'Bahamas',
    'Bahrain',
    'Bangladesh',
    'Barbados',
    'Belarus',
    'Belgium',
    'Belize',
    'Benin',
    'Bhutan',
    'Bolivia',
    'Bosnia and Herzegovina',
    'Botswana',
    'Brazil',
    'Brunei',
    'Bulgaria',
    'Burkina Faso',
    'Burundi',
    'Côte d\'Ivoire',
    'Cabo Verde',
    'Cambodia',
    'Cameroon',
    'Canada',
    'Central African Republic',
    'Chad',
    'Chile',
    'China',
    'Colombia',
    'Comoros',
    'Congo (Congo-Brazzaville)',
    'Costa Rica',
    'Croatia',
    'Cuba',
    'Cyprus',
    'Czech Republic',
    'Denmark',
    'Djibouti',
    'Dominica',
    'Dominican Republic',
    'East Timor (Timor-Leste)',
    'Ecuador',
    'Egypt',
    'El Salvador',
    'Equatorial Guinea',
    'Eritrea',
    'Estonia',
    'Eswatini',
    'Ethiopia',
    'Fiji',
    'Finland',
    'France',
    'Gabon',
    'The Gambia',
    'Georgia',
    'Germany',
    'Ghana',
    'Greece',
    'Grenada',
    'Guatemala',
    'Guinea',
    'Guinea-Bissau',
    'Guyana',
    'Haiti',
    'Honduras',
    'Hungary',
    'Iceland',
    'India',
    'Indonesia',
    'Iran',
    'Iraq',
    'Ireland',
    'Israel',
    'Italy',
    'Jamaica',
    'Japan',
    'Jordan',
    'Kazakhstan',
    'Kenya',
    'Kiribati',
    'Korea, North',
    'Korea, South',
    'Kosovo',
    'Kuwait',
    'Kyrgyzstan',
    'Laos',
    'Latvia',
    'Lebanon',
    'Lesotho',
    'Liberia',
    'Libya',
    'Liechtenstein',
    'Lithuania',
    'Luxembourg',
    'Madagascar',
    'Malawi',
    'Malaysia',
    'Maldives',
    'Mali',
    'Malta',
    'Marshall Islands',
    'Mauritania',
    'Mauritius',
    'Mexico',
    'Micronesia, Federated States of',
    'Moldova',
    'Monaco',
    'Mongolia',
    'Montenegro',
    'Morocco',
    'Mozambique',
    'Myanmar (Burma)',
    'Namibia',
    'Nauru',
    'Nepal',
    'Netherlands',
    'New Zealand',
    'Nicaragua',
    'Niger',
    'Nigeria',
    'North Macedonia',
    'Norway',
    'Oman',
    'Pakistan',
    'Palau',
    'Panama',
    'Papua New Guinea',
    'Paraguay',
    'Peru',
    'Philippines',
    'Poland',
    'Portugal',
    'Qatar',
    'Romania',
    'Russia',
    'Rwanda',
    'Saint Kitts and Nevis',
    'Saint Lucia',
    'Saint Vincent and the Grenadines',
    'Samoa',
    'San Marino',
    'Sao Tome and Principe',
    'Saudi Arabia',
    'Senegal',
    'Serbia',
    'Seychelles',
    'Sierra Leone',
    'Singapore',
    'Slovakia',
    'Slovenia',
    'Solomon Islands',
    'Somalia',
    'South Africa',
    'Spain',
    'Sri Lanka',
    'Sudan',
    'Sudan, South',
    'Suriname',
    'Sweden',
    'Switzerland',
    'Syria',
    'Taiwan',
    'Tajikistan',
    'Tanzania',
    'Thailand',
    'Togo',
    'Tonga',
    'Trinidad and Tobago',
    'Tunisia',
    'Turkey',
    'Turkmenistan',
    'Tuvalu',
    'Uganda',
    'Ukraine',
    'United Arab Emirates',
    'United Kingdom',
    'United States',
    'Uruguay',
    'Uzbekistan',
    'Vanuatu',
    'Vatican City',
    'Venezuela',
    'Vietnam',
    'Yemen',
    'Zambia',
    'Zimbabwe'
]);

/**
 * Write the leave application response
 */
Configure::write('LEAVE_APPLICATION', [
    'RECOMMENDATION_TYPE' => [
        'Approved' => 0,
        'Disapproved' => 1
    ],
    'COMMUTATION' => [
        'Requested' => 1,
        'NotRequested' => 2
    ]
]);
