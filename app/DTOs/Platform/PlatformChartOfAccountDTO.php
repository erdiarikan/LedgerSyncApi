<?php

namespace App\DTOs\Platform;

use Carbon\Carbon;
use http\Exception\InvalidArgumentException;

readonly class PlatformChartOfAccountDTO
{
    public string $externalId;
    public ?string $code;
    public ?string $name;
    public ?string $status;
    public ?string $accountType;
    public ?string $taxType;
    public ?string $description;
    public ?string $class;
    public ?string $systemAccount;
    public ?bool $enablePaymentToAccount;
    public ?bool $showInExpenseClaims;
    public ?string $bankAccountNumber;
    public ?string $bankAccountType;
    public ?string $currencyCode;
    public ?string $reportingCode;
    public ?string $reportingCodeName;
    public ?bool $hasAttachments;
    public ?Carbon $chartOfAccountUpdatedAt;
    public ?bool $addToWatchlist;

    public function __construct(array $data)
    {
        $this->externalId = $data['AccountID'] ?? throw new InvalidArgumentException('AccountID is required.');
        $this->code = $data['Code'] ?? null;
        $this->name = $data['Name'] ?? null;
        $this->status = $data['Status'] ?? null;
        $this->accountType = $data['Type'] ?? null;
        $this->taxType = $data['TaxType'] ?? null;
        $this->description = $data['Description'] ?? null;
        $this->class = $data['Class'] ?? null;
        $this->systemAccount = $data['SystemAccount'] ?? null;
        $this->enablePaymentToAccount = $data['EnablePaymentToAccount'] ?? null;
        $this->showInExpenseClaims = $data['ShowInExpenseClaims'] ?? null;
        $this->bankAccountNumber = $data['BankAccountNumber'] ?? null;
        $this->bankAccountType = $data['BankAccountType'] ?? null;
        $this->currencyCode = $data['CurrencyCode'] ?? null;
        $this->reportingCode = $data['ReportingCode'] ?? null;
        $this->reportingCodeName = $data['ReportingCodeName'] ?? null;
        $this->hasAttachments = $data['HasAttachments'] ?? null;
        $this->chartOfAccountUpdatedAt = $data['UpdatedDateUTC'] ?
            Carbon::parse($data['UpdatedDateUTC']) : null;
        $this->addToWatchlist = $data['AddToWatchlist'] ?? null;
    }
}
