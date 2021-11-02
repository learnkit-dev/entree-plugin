<?php

$settings = array(
    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => false,

    // Enable debug mode (to print errors)
    'debug' => false,

    // Set a BaseURL to be used instead of try to guess
    // the BaseURL of the view that process the SAML Message.
    // Ex. http://sp.example.com/
    //     http://example.com/sp/
    'baseurl' => 'https://entree.share.codecycler.dev/entree',

    // Service Provider Data that we are deploying
    'sp' => array(
        // Identifier of the SP entity  (must be a URI)
        'entityId' => 'https://entree.share.codecycler.dev/entree',
        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array(
            // URL Location where the <Response> from the IdP will be returned
            'url' => 'https://entree.share.codecycler.dev/entree/acs',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-POST binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
        ),
        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => '',
        'privateKey' => '',
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array(
        // Identifier of the IdP entity  (must be a URI)
        'entityId' => 'https://aselect-s.entree.kennisnet.nl/openaselect',
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array(
            // URL Target of the IdP where the SP will send the Authentication Request Message
            'url' => env('ENTREE_IDP_SSO_URL', 'https://aselect-s.entree.kennisnet.nl/openaselect/profiles/saml/sso/web'),
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ),
        // Public x509 certificate of the IdP
        'x509cert' => 'MIIF4TCCA8mgAwIBAgIEXXr4LzANBgkqhkiG9w0BAQsFADCBoDELMAkGA1UEBhMCTkwxFTATBgNV
BAgTDFp1aWQtSG9sbGFuZDETMBEGA1UEBxMKWm9ldGVybWVlcjEcMBoGA1UEChMTU3RpY2h0aW5n
IEtlbm5pc25ldDEZMBcGA1UECxMQRW50cmVlIEZlZGVyYXRpZTEsMCoGA1UEAxMjYXNlbGVjdC5z
dGFnaW5nLmVudHJlZS5rZW5uaXNuZXQubmwwHhcNMTcwNzI0MTMzMTEwWhcNMjIwOTAxMTMzMTEw
WjCBoDELMAkGA1UEBhMCTkwxFTATBgNVBAgTDFp1aWQtSG9sbGFuZDETMBEGA1UEBxMKWm9ldGVy
bWVlcjEcMBoGA1UEChMTU3RpY2h0aW5nIEtlbm5pc25ldDEZMBcGA1UECxMQRW50cmVlIEZlZGVy
YXRpZTEsMCoGA1UEAxMjYXNlbGVjdC5zdGFnaW5nLmVudHJlZS5rZW5uaXNuZXQubmwwggIiMA0G
CSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQCzk5qEmbwFvrVVDApB2ggPoYQQiIXNiW+1J4fId9p5
51vGgXBjVQvoYPcYpLHhHdh+LaxMWpCES67NUIXZODZtqfj6Q3iQkqE6+N75RSRg4sPG/FmsYCnI
TBNfQyVIyNfo/5WvGbCtKZarXMtYk6hthRuwDcxOf4xAhALyS3x6cRmedSpZVBg8Ysgdriivf4AQ
lNy7yHxhN+vRWJ4F5D1ZFg5JKNl5o4uh2QVLymIH4MJAe5KMfsEQao6HTQgWRLWHcmfTCMDlYyZv
149iCwPrN7rl8tI1BBx9gnf6Yrbc4VWGFn+rnEYub4CcuLSgc0f6uUrL/AhJwy+2PaHXAcnrpQ7g
71BOG1hbHgpdnr+dRsjzHFUf4axBsVqxr6scTXfcYDzMK2HyGheGjYpa8uX+b1s9V+0KMWbBIp7X
TmJDoTnrHj7K+pXAa1ZUK3/kLuexRYIDf6MUh6wTn4AT8v/pERdg5HdIcV8pg/cilxkSu7iwXGgn
ZpGzJYmfu0NcZLbGea1fEpAAB+0yHw1M3mx6FSKPE27DkHK592B0h1GzX6OM0ngURMl7gK+jVwGH
m6JJrKaSqSOXRy79a3HY7W8+WLMOlssq4aJT5nhxWGBDy+aSy0W+frhKV3WeXevYqG/gRiv8WVV+
m2D29c49cMzr18Z5+gkAuCJg7Sha6AzyYwIDAQABoyEwHzAdBgNVHQ4EFgQUaE7jTfVApSIl5iNX
6FsEFgSLBC4wDQYJKoZIhvcNAQELBQADggIBAKgaSgLmtFYFU3sNPrRJSAd+xqb1TE7GJGC1ywNd
SicZiV5MVkFYzm7UkUArbuBnFspkMaxYk4pgXvJQrGppEJAhGfpOwsSNZcn35hRfvvGpbiIPw4PN
c6//g5qbWXgVqkzzNZ3Wu6HbG5zBznO1kFu1izXIAIJC534EGbkAvcrn5axSOZt4eR31lSsgckNk
QLV568kyMi3i/dvwC5FL12dbCASqNt8+RvUynhC0BpVJ+ihppPMEYxFcoLorh5uXNpPv3CiUc55g
msjF57VYmicHghikNQ31WAuKntanyxExLOwSumM7MJR411OF+V+NmpO7x+Wixzxv0tPRh5Wyo6vG
puQWTMiGz2idGIfaxiJ8JXa9ubUfOpjrXsgtkYlu1R3K2Cbt9n7V2UaVNyGQMT2m6WCupPXaP/UE
DwwVN+YKl7O/tLUYRvmTnOed5zpOwX6WELT9Gshmi9T3lVn/p3XnGxxz8RpnrcQbc/MvGjybsRsj
6uFjsGWLBSqhn9e10awAl9JrJtojDje7PhADopUpe9dGbKBBgUBewDorkf55L+l5XNiH3f+Ne7jn
7uD696761sUpsGnDlWjf6oGIsG8YulDhAf8hZTOlB4Xi3GowtQ42gCKVgE1cgXeDRjkOIgSHhXuF
N99D5dVbx2vmPcidF8Lqre2S6R7AvpP0vVuh',
    ),
);
