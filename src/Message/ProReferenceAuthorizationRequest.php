<?php

namespace Omnipay\PayPal\Message;

/**
 * PayPal Pro ReferenceTransaction Request
 */
class ProReferenceAuthorizationRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('cardReference');

        $data = $this->getBaseData();
        $data['METHOD'] = 'DoReferenceTransaction';
        $data['REFERENCEID'] = $this->getCardReference();
        $data['PAYMENTACTION'] = 'Authorization';
        $data['IPADDRESS'] = $this->getClientIp();

        $data['AMT'] = $this->getAmount();
        $data['CURRENCYCODE'] = $this->getCurrency();
        $data['INVNUM'] = $this->getTransactionId();
        $data['DESC'] = $this->getDescription();

        // add credit card details
        /* Only add the credit card details if we want to update. Leaving out for now.
        if (false && $this->getCard()) {
            $data['EXPDATE'] = $this->getCard()->getExpiryDate('mY');
            $data['STARTDATE'] = $this->getCard()->getStartDate('mY');
            $data['CVV2'] = $this->getCard()->getCvv();
            $data['ISSUENUMBER'] = $this->getCard()->getIssueNumber();
            $data['FIRSTNAME'] = $this->getCard()->getFirstName();
            $data['LASTNAME'] = $this->getCard()->getLastName();
            $data['EMAIL'] = $this->getCard()->getEmail();
            $data['STREET'] = $this->getCard()->getAddress1();
            $data['STREET2'] = $this->getCard()->getAddress2();
            $data['CITY'] = $this->getCard()->getCity();
            $data['STATE'] = $this->getCard()->getState();
            $data['ZIP'] = $this->getCard()->getPostcode();
            $data['COUNTRYCODE'] = strtoupper(
                $this->getCard()->getCountry()
            );
        }
        */

        return $data;
    }
}
