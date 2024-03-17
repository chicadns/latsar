-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2022 at 11:11 AM
-- Server version: 10.3.28-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpatipti_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `per_page` int(11) NOT NULL DEFAULT 20,
  `site_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Snipe IT Asset Management',
  `qr_code` int(11) DEFAULT NULL,
  `qr_text` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_asset_name` int(11) DEFAULT NULL,
  `display_checkout_date` int(11) DEFAULT NULL,
  `display_eol` int(11) DEFAULT NULL,
  `auto_increment_assets` int(11) NOT NULL DEFAULT 0,
  `auto_increment_prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `load_remote` tinyint(1) NOT NULL DEFAULT 1,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alert_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alerts_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `default_eula_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'QRCODE',
  `slack_endpoint` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slack_channel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slack_botname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_css` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` tinyint(1) NOT NULL DEFAULT 1,
  `ldap_enabled` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_server` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_uname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_pword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_basedn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_filter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_username_field` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'samaccountname',
  `ldap_lname_field` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'sn',
  `ldap_fname_field` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'givenname',
  `ldap_auth_filter_query` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'uid=samaccountname',
  `ldap_version` int(11) DEFAULT 3,
  `ldap_active_flag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_dept` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_emp_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_phone_field` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_jobtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_multiple_companies_support` tinyint(1) NOT NULL DEFAULT 0,
  `ldap_server_cert_ignore` tinyint(1) NOT NULL DEFAULT 0,
  `locale` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `labels_per_page` tinyint(1) NOT NULL DEFAULT 30,
  `labels_width` decimal(6,5) NOT NULL DEFAULT 2.62500,
  `labels_height` decimal(6,5) NOT NULL DEFAULT 1.00000,
  `labels_pmargin_left` decimal(6,5) NOT NULL DEFAULT 0.21975,
  `labels_pmargin_right` decimal(6,5) NOT NULL DEFAULT 0.21975,
  `labels_pmargin_top` decimal(6,5) NOT NULL DEFAULT 0.50000,
  `labels_pmargin_bottom` decimal(6,5) NOT NULL DEFAULT 0.50000,
  `labels_display_bgutter` decimal(6,5) NOT NULL DEFAULT 0.07000,
  `labels_display_sgutter` decimal(6,5) NOT NULL DEFAULT 0.05000,
  `labels_fontsize` tinyint(1) NOT NULL DEFAULT 9,
  `labels_pagewidth` decimal(7,5) NOT NULL DEFAULT 8.50000,
  `labels_pageheight` decimal(7,5) NOT NULL DEFAULT 11.00000,
  `labels_display_name` tinyint(1) NOT NULL DEFAULT 0,
  `labels_display_serial` tinyint(1) NOT NULL DEFAULT 1,
  `labels_display_tag` tinyint(1) NOT NULL DEFAULT 1,
  `alt_barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'C128',
  `alt_barcode_enabled` tinyint(1) DEFAULT 1,
  `alert_interval` int(11) DEFAULT 30,
  `alert_threshold` int(11) DEFAULT 5,
  `email_domain` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'filastname',
  `username_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'filastname',
  `is_ad` tinyint(1) NOT NULL DEFAULT 0,
  `ad_domain` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_port` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '389',
  `ldap_tls` tinyint(1) NOT NULL DEFAULT 0,
  `zerofill_count` int(11) NOT NULL DEFAULT 5,
  `ldap_pw_sync` tinyint(1) NOT NULL DEFAULT 1,
  `two_factor_enabled` tinyint(1) DEFAULT NULL,
  `require_accept_signature` tinyint(1) NOT NULL DEFAULT 0,
  `date_display_format` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y-m-d',
  `time_display_format` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'h:i A',
  `next_auto_tag_base` bigint(20) NOT NULL DEFAULT 1,
  `login_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_max_h` int(11) DEFAULT 50,
  `pwd_secure_uncommon` tinyint(1) NOT NULL DEFAULT 0,
  `pwd_secure_complexity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pwd_secure_min` int(11) NOT NULL DEFAULT 8,
  `audit_interval` int(11) DEFAULT NULL,
  `audit_warning_days` int(11) DEFAULT NULL,
  `show_url_in_emails` tinyint(1) NOT NULL DEFAULT 0,
  `custom_forgot_pass_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_alerts_in_menu` tinyint(1) NOT NULL DEFAULT 1,
  `labels_display_company_name` tinyint(1) NOT NULL DEFAULT 0,
  `show_archived_in_list` tinyint(1) NOT NULL DEFAULT 0,
  `dashboard_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_footer` char(5) COLLATE utf8mb4_unicode_ci DEFAULT 'on',
  `footer_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modellist_displays` char(191) COLLATE utf8mb4_unicode_ci DEFAULT 'image,category,manufacturer,model_number',
  `login_remote_user_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `login_common_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `login_remote_user_custom_logout_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `skin` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_images_in_email` tinyint(1) NOT NULL DEFAULT 1,
  `admin_cc_email` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `labels_display_model` tinyint(1) NOT NULL DEFAULT 0,
  `privacy_policy_link` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version_footer` char(5) COLLATE utf8mb4_unicode_ci DEFAULT 'on',
  `unique_serial` tinyint(1) NOT NULL DEFAULT 0,
  `logo_print_assets` tinyint(1) NOT NULL DEFAULT 0,
  `depreciation_method` char(10) COLLATE utf8mb4_unicode_ci DEFAULT 'default',
  `favicon` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_logo` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label_logo` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_user_skin` tinyint(1) NOT NULL DEFAULT 0,
  `show_assigned_assets` tinyint(1) NOT NULL DEFAULT 0,
  `login_remote_user_header_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ad_append_domain` tinyint(1) NOT NULL DEFAULT 0,
  `saml_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `saml_idp_metadata` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saml_attr_mapping_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saml_forcelogin` tinyint(1) NOT NULL DEFAULT 0,
  `saml_slo` tinyint(1) NOT NULL DEFAULT 0,
  `saml_sp_x509cert` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saml_sp_privatekey` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saml_custom_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saml_sp_x509certNew` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `digit_separator` char(191) COLLATE utf8mb4_unicode_ci DEFAULT '1234.56'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `user_id`, `per_page`, `site_name`, `qr_code`, `qr_text`, `display_asset_name`, `display_checkout_date`, `display_eol`, `auto_increment_assets`, `auto_increment_prefix`, `load_remote`, `logo`, `header_color`, `alert_email`, `alerts_enabled`, `default_eula_text`, `barcode_type`, `slack_endpoint`, `slack_channel`, `slack_botname`, `default_currency`, `custom_css`, `brand`, `ldap_enabled`, `ldap_server`, `ldap_uname`, `ldap_pword`, `ldap_basedn`, `ldap_filter`, `ldap_username_field`, `ldap_lname_field`, `ldap_fname_field`, `ldap_auth_filter_query`, `ldap_version`, `ldap_active_flag`, `ldap_dept`, `ldap_emp_num`, `ldap_email`, `ldap_phone_field`, `ldap_jobtitle`, `ldap_country`, `full_multiple_companies_support`, `ldap_server_cert_ignore`, `locale`, `labels_per_page`, `labels_width`, `labels_height`, `labels_pmargin_left`, `labels_pmargin_right`, `labels_pmargin_top`, `labels_pmargin_bottom`, `labels_display_bgutter`, `labels_display_sgutter`, `labels_fontsize`, `labels_pagewidth`, `labels_pageheight`, `labels_display_name`, `labels_display_serial`, `labels_display_tag`, `alt_barcode`, `alt_barcode_enabled`, `alert_interval`, `alert_threshold`, `email_domain`, `email_format`, `username_format`, `is_ad`, `ad_domain`, `ldap_port`, `ldap_tls`, `zerofill_count`, `ldap_pw_sync`, `two_factor_enabled`, `require_accept_signature`, `date_display_format`, `time_display_format`, `next_auto_tag_base`, `login_note`, `thumbnail_max_h`, `pwd_secure_uncommon`, `pwd_secure_complexity`, `pwd_secure_min`, `audit_interval`, `audit_warning_days`, `show_url_in_emails`, `custom_forgot_pass_url`, `show_alerts_in_menu`, `labels_display_company_name`, `show_archived_in_list`, `dashboard_message`, `support_footer`, `footer_text`, `modellist_displays`, `login_remote_user_enabled`, `login_common_disabled`, `login_remote_user_custom_logout_url`, `skin`, `show_images_in_email`, `admin_cc_email`, `labels_display_model`, `privacy_policy_link`, `version_footer`, `unique_serial`, `logo_print_assets`, `depreciation_method`, `favicon`, `email_logo`, `label_logo`, `allow_user_skin`, `show_assigned_assets`, `login_remote_user_header_name`, `ad_append_domain`, `saml_enabled`, `saml_idp_metadata`, `saml_attr_mapping_username`, `saml_forcelogin`, `saml_slo`, `saml_sp_x509cert`, `saml_sp_privatekey`, `saml_custom_settings`, `saml_sp_x509certNew`, `digit_separator`) VALUES
(1, '2021-07-13 03:42:37', '2022-08-15 03:42:38', 1, 20, 'Mania', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 'setting-logo-ggeFhafMeI.png', 'rgba(0,162,244,0.99)', 'pti@bps.go.id', 1, 'default eula', 'QRCODE', NULL, NULL, NULL, 'IDR', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'samaccountname', 'sn', 'givenname', 'uid=samaccountname', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 'id', 30, '2.62500', '1.00000', '0.21975', '0.21975', '0.50000', '0.50000', '0.07000', '0.05000', 9, '8.50000', '11.00000', 0, 1, 1, 'C128', 1, 30, 5, 'gmail.com', 'firstname.lastname', 'filastname', 0, NULL, '389', 0, 5, 1, NULL, 0, 'M j, Y', 'H:i', 5, NULL, 50, 0, NULL, 10, NULL, NULL, 0, NULL, 1, 0, 0, NULL, 'off', '```Manajemen Inventarisasi Aset TI``` _Direktorat Sistem Informasi Statistik_ - BPS RI', 'image,category,manufacturer,model_number', 0, 0, '', 'blue', 1, NULL, 0, NULL, 'admin', 0, 1, 'default', 'favicon-uploaded.png', 'setting-email_logo-Vywd2HyUQ5.png', NULL, 0, 0, '', 0, 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<!--\r\n  ~ Copyright 2016 Red Hat, Inc. and/or its affiliates\r\n  ~ and other contributors as indicated by the @author tags.\r\n  ~\r\n  ~ Licensed under the Apache License, Version 2.0 (the \"License\");\r\n  ~ you may not use this file except in compliance with the License.\r\n  ~ You may obtain a copy of the License at\r\n  ~\r\n  ~ http://www.apache.org/licenses/LICENSE-2.0\r\n  ~\r\n  ~ Unless required by applicable law or agreed to in writing, software\r\n  ~ distributed under the License is distributed on an \"AS IS\" BASIS,\r\n  ~ WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.\r\n  ~ See the License for the specific language governing permissions and\r\n  ~ limitations under the License.\r\n  -->\r\n\r\n<EntitiesDescriptor Name=\"urn:keycloak\" xmlns=\"urn:oasis:names:tc:SAML:2.0:metadata\"\r\n					xmlns:dsig=\"http://www.w3.org/2000/09/xmldsig#\">\r\n	<EntityDescriptor entityID=\"https://sso.bps.go.id/auth/realms/pegawai-bps\">\r\n		<IDPSSODescriptor WantAuthnRequestsSigned=\"true\"\r\n			protocolSupportEnumeration=\"urn:oasis:names:tc:SAML:2.0:protocol\">\r\n                        <KeyDescriptor use=\"signing\">\r\n                          <dsig:KeyInfo>\r\n                            <dsig:KeyName>kc3CEu8UM5iJBvzzvgZv-7cxFJLr2MMrhU0y7_4faE4</dsig:KeyName>\r\n                            <dsig:X509Data>\r\n                              <dsig:X509Certificate>MIICpTCCAY0CBgFvkz7EBzANBgkqhkiG9w0BAQsFADAWMRQwEgYDVQQDDAtwZWdhd2FpLWJwczAeFw0yMDAxMTEwNjE0MjFaFw0zMDAxMTEwNjE2MDFaMBYxFDASBgNVBAMMC3BlZ2F3YWktYnBzMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlXNUXGdWBglPs3dy03w9VcEcIv17OlBNQxJcTWwoaRlmLsSHjrC0zbj6Q31jQSQQvSc8NbbnIhBI/7Ej02VFmoDmc4D8QIcliNEdTDiw9QDlYX8yNh6sxwTHWwZQ6VFDrkNj5ayDYiEOU1vibczI1HiJnIijrwnldu+fo0N5rPg0Er9QXk22Losk2rVFQk0Z5zm3EsKhRn17HkRqzToqEgr/SXAVHd7qt9FwaUS3efIoT/yVicup8p/h0zBP5P8PchFqJkc4Ha44AaXVj3/bMM3MfoXL7oAcBYCJe5QE79hznNxPGmCdDWXI1ZSVj1RdZ4fOYtleCgB45qIVnWm1mQIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQCQmGT68FQypfgjXUjEDJXeyCeh1/iBxxlzhjgEn02jq2dhHI6SSh6iYxe/wqyFpvV3X3N5TAeHC/8ttYc4251Ceyxv50UkGHKzDLgvX113lWwmpe+R3lAuB9jgMfh8jMvsdgPplFVozBcPEhZ7SpwviEAaIkQCDznj+XHJxssI1c8WYSxvOFjyIP/ZItVxJ3HcJ5Y808rSGXF6k3RLO+pD3rtlzsqwvAQsFp9exdErN66H6mjWdoVC8H4N+wU120XqLHwP/7fuqq0Yu2nhQhmhxigcp34we/rep4UQ+mh9aAuarFBgI1AtzeKDqsF4vlJswjkLQaGc8QT17kKva5/2</dsig:X509Certificate>\r\n                            </dsig:X509Data>\r\n                          </dsig:KeyInfo>\r\n                        </KeyDescriptor>\r\n\r\n			<SingleLogoutService\r\n					Binding=\"urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST\"\r\n					Location=\"https://sso.bps.go.id/auth/realms/pegawai-bps/protocol/saml\" />\r\n			<SingleLogoutService\r\n					Binding=\"urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect\"\r\n					Location=\"https://sso.bps.go.id/auth/realms/pegawai-bps/protocol/saml\" />\r\n			<NameIDFormat>urn:oasis:names:tc:SAML:2.0:nameid-format:persistent</NameIDFormat>\r\n			<NameIDFormat>urn:oasis:names:tc:SAML:2.0:nameid-format:transient</NameIDFormat>\r\n			<NameIDFormat>urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified</NameIDFormat>\r\n			<NameIDFormat>urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress</NameIDFormat>\r\n			<SingleSignOnService Binding=\"urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST\"\r\n				Location=\"https://sso.bps.go.id/auth/realms/pegawai-bps/protocol/saml\" />\r\n			<SingleSignOnService\r\n				Binding=\"urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect\"\r\n				Location=\"https://sso.bps.go.id/auth/realms/pegawai-bps/protocol/saml\" />\r\n			<SingleSignOnService\r\n				Binding=\"urn:oasis:names:tc:SAML:2.0:bindings:SOAP\"\r\n				Location=\"https://sso.bps.go.id/auth/realms/pegawai-bps/protocol/saml\" />\r\n		</IDPSSODescriptor>\r\n	</EntityDescriptor>\r\n</EntitiesDescriptor>', NULL, 0, 1, '-----BEGIN CERTIFICATE-----\nMIIDbDCCAlSgAwIBAgIBADANBgkqhkiG9w0BAQsFADBPMQswCQYDVQQGEwJVUzEM\nMAoGA1UECAwDTi9BMQwwCgYDVQQHDANOL0ExETAPBgNVBAoMCFNuaXBlLUlUMREw\nDwYDVQQDDAhTbmlwZS1JVDAeFw0yMjA4MTUwMzQyMzFaFw0zMjA4MTIwMzQyMzFa\nME8xCzAJBgNVBAYTAlVTMQwwCgYDVQQIDANOL0ExDDAKBgNVBAcMA04vQTERMA8G\nA1UECgwIU25pcGUtSVQxETAPBgNVBAMMCFNuaXBlLUlUMIIBIjANBgkqhkiG9w0B\nAQEFAAOCAQ8AMIIBCgKCAQEAz92LWqLVF7sKDtNT5a34uvWiTTqv3wRvMT2qI/fO\n1c+6oLyNBjZ0wQNaWdcOzYZ2dQl+AfP0c912bmAiD9A/sRl+fJ5uoTGHFUk/R8Ac\nb8JxREWIXqEwee32/TNkjsQFzKBvtAK1hf3q6YEu1e20/8smsauPGdpbOAB1K3EW\nDvzEVcpFXOEmt25ui2Aw7gtWCmwIG4X707yjewezR+0HvAXHo1OhbBlHhbwGQ+Un\nXWgDL9X30t32K4RqcaNhQ7hahk5lEqEyXmDUxh1odLLL2Ohg7f+4UH1DwMCKMZVI\nVbZHj6gT9DRitP6wd7vaHoVibswQeNeE2ueuqmNMEKDO6QIDAQABo1MwUTAdBgNV\nHQ4EFgQU9ZUtnfmwMzVRcgGuxYxvZIW84ScwHwYDVR0jBBgwFoAU9ZUtnfmwMzVR\ncgGuxYxvZIW84ScwDwYDVR0TAQH/BAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAQEA\nd976a1QLNIqjLQpMf2l99tt3FIVobVM62A2nkuUBWUEVQmixrn9+bHusXQsy1YWB\n675F+Tjfd+PtESAzKf/8Q70lqVVAcnJJ20zTm34c84omysT12HRFeBDqZdN9O5eN\nuadUGyAkXtsZg2cnknbFxr0hQI+OaMPsQ8VIy8BGX+oy5HLdN+wdZUXB+y9j+svI\nW/uytVglMNzLMdwG4PPbHqro/IcmoNEEXe4+o7+PhQaHfCZheOqgfPvmIQt8Vkhi\nkYbLza1/YLyLavB7/T4JutAAYJwCHXw7ZvKEpIKrIjHpW4tYtZlT90jiRuXeXWKV\nMO2xDuCeWHPtabBSDNC6mQ==\n-----END CERTIFICATE-----\n', '-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDP3YtaotUXuwoO\n01Plrfi69aJNOq/fBG8xPaoj987Vz7qgvI0GNnTBA1pZ1w7NhnZ1CX4B8/Rz3XZu\nYCIP0D+xGX58nm6hMYcVST9HwBxvwnFERYheoTB57fb9M2SOxAXMoG+0ArWF/erp\ngS7V7bT/yyaxq48Z2ls4AHUrcRYO/MRVykVc4Sa3bm6LYDDuC1YKbAgbhfvTvKN7\nB7NH7Qe8BcejU6FsGUeFvAZD5SddaAMv1ffS3fYrhGpxo2FDuFqGTmUSoTJeYNTG\nHWh0ssvY6GDt/7hQfUPAwIoxlUhVtkePqBP0NGK0/rB3u9oehWJuzBB414Ta566q\nY0wQoM7pAgMBAAECggEBAIN30a2Pk0shByl9S3DW6ZwFw5Mo7RcWjOUN5VA+aVkd\nuyHyXxdw1cNFxZ1QwZIH22AGkuXVT+UASulgb+qkgcQXJcLXyYy18IPsAdP1k4az\n6kON3sRLGofjk/Vszcrl++0CA+RMWlbW0/6/r8mqQHIQIPb6VNW7Hzp6P6EsMxFi\ndIvvvWr32gC+v1yeXKkShvlYyMg0zyxt/gLc+VAGiA9zX2o+fv6jZp+khXifhae5\ntBlv9tOjyNi+TMdk9q3vjajs2XyhW0bF1FN+kx5lXxCbgkZP92EVcHp8JqoVWDWn\nw3PEnJkBqU+GPZhOjLuo4we6zmH7uLYFuyFkr+GDJMkCgYEA+EmLJknd+ufi1Viu\n/lirNz7Q2CRr+Z6pGuQUQ1Vy/M4G3b2GTC0G0DEF+Miu/BX9CYZuD82dD0OgN8aB\n9UvUstxy1f7hW9GxqwS0IsgeRUz8mceQ852xPDGvG2gHNCh/VGxjtcpRmIuqRf+P\nqLX/Icm5odnYqQM1EPr2Wd9QVmcCgYEA1lKNv1C9sjlZkjw61KLLhc0m10UlQMOD\n2YQlDhx//vXhRnrhuAhTGPplm6kn4DTuOAI+JE1GjmlC95ocW1yCVY4mANUB1i2d\nWCrCAb5D+uFIovWNrPBIBiBgOHX0fUaMmwtm86o/qgalv5j92nWrZ12BEgLy++Xv\n5o51ZkPsPi8CgYEA6XKctx9069jj2p1LzDIqqgMR8mgsbcPUVEhnFPhe6Xv90LfG\nchFT+qRdbRGkFbnG9RHEom89YYDAQDEROEZYcuP7xWGlGuQLHTWK+bkXXSmJyD1v\n+N8oKeS9NBOX0l7Redt/1Qmptrh7HN2xgXu9q1M0iw19PUyatKCCyPXDX7kCgYEA\nuSOFKSAxThT2iDmZRHgAweuvQsSLYr/CVRMvA1qhQvjaCo06EUS3q9saDPZ56Ncw\ndZeSYL+UVI8fd05ccpueRxPNRmi69m5e/nupLeJTTRRxL7xZD2xde1VaaUuT0Ogx\nq/mUjKaj6ldltPYPTDjbwSXnykxb5DgEHbEwPxArsqcCgYBrryoFw/VSgomqxu4x\ntQGLpcfg1jlGnKuTuGljQ/1XblygUkzR0kepno+9EQ6bsJlwimO+VkBaHi4K25x9\nDSwJK2LNVzjaVjwCodV3Q74EcqQVeBuE7D/cT+Xt4cUcqV2kJ60OMqgnUktNYPaC\nRor7XnOfFunsRrBCSzz2ypQTtg==\n-----END PRIVATE KEY-----\n', NULL, '', '1.234,56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
