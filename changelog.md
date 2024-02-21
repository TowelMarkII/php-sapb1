# Changelog

## v1.1.0 - B1S layer version 10.00.210 support

Fixed issues
- #3 SAPException throws fatal error

Changes
- added SAPException for B1S layer version 10.00.210 and higher.
- added b1s_version in config object to select older version v10.00.140 include for SAPException.  
  Version is compared to be higher, equal or lower than version in b1s_version property.  
  If no version specified, the version is assumed to be 10.00.210 or higher.
- added response object and response body property to SAPException to help diagnose problems

## v1.0.0 - original library code
- created a simple build setup for the current library code. The code of Syed Hussimi.