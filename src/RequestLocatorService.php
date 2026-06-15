<?php

declare(strict_types=1);

namespace PlaystationStoreApi;

use BackedEnum;
use PlaystationStoreApi\Enum\OperationSha256Enum;
use PlaystationStoreApi\Exception\RequestNotFoundException;
use PlaystationStoreApi\Request\RequestAddOnsByTitleId;
use PlaystationStoreApi\Request\RequestConceptById;
use PlaystationStoreApi\Request\RequestConceptByProductId;
use PlaystationStoreApi\Request\RequestConceptForGameInfo;
use PlaystationStoreApi\Request\RequestConceptForGameTitle;
use PlaystationStoreApi\Request\RequestPricingDataByConceptId;
use PlaystationStoreApi\Request\RequestProductById;
use PlaystationStoreApi\Request\RequestProductList;
use PlaystationStoreApi\Request\RequestPSPlusTier;
use PlaystationStoreApi\Request\RequestProductStarRating;
use PlaystationStoreApi\Request\RequestConceptForCompatibilityNotices;
use PlaystationStoreApi\Request\RequestConceptStarRating;
use PlaystationStoreApi\Request\RequestConceptRetrieveForContentRating;
use PlaystationStoreApi\Request\RequestConceptRetrieveForAccessibilityFeatures;
use PlaystationStoreApi\Request\RequestConceptRetrieveForMediaCarousel;
use PlaystationStoreApi\Request\RequestConceptRetrieveForMedia;
use PlaystationStoreApi\Request\RequestWcaConceptRetrieveForLegalText;

final class RequestLocatorService
{
    /**
     * @var array<string, BackedEnum>
     */
    private array $request = [];

    public static function default(): self
    {
        $locator = new self();

        $locator->set(RequestPSPlusTier::class, OperationSha256Enum::featuresRetrieve);
        $locator->set(RequestProductList::class, OperationSha256Enum::categoryGridRetrieve);
        $locator->set(RequestProductById::class, OperationSha256Enum::metGetProductById);
        $locator->set(RequestConceptById::class, OperationSha256Enum::metGetConceptById);
        $locator->set(RequestConceptByProductId::class, OperationSha256Enum::metGetConceptByProductIdQuery);
        $locator->set(RequestPricingDataByConceptId::class, OperationSha256Enum::metGetPricingDataByConceptId);
        $locator->set(RequestAddOnsByTitleId::class, OperationSha256Enum::metGetAddOnsByTitleId);
        $locator->set(RequestProductStarRating::class, OperationSha256Enum::wcaProductStarRatingRetrive);
        $locator->set(RequestConceptStarRating::class, OperationSha256Enum::wcaConceptStarRatingRetrive);
        $locator->set(RequestConceptForGameInfo::class, OperationSha256Enum::conceptRetrieveForGameInfo);
        $locator->set(RequestConceptForGameTitle::class, OperationSha256Enum::conceptRetrieveForGameTitle);
        $locator->set(RequestConceptForCompatibilityNotices::class, OperationSha256Enum::conceptRetrieveForCompatibilityNotices);
        $locator->set(RequestConceptRetrieveForContentRating::class, OperationSha256Enum::conceptRetrieveForContentRating);
        $locator->set(RequestConceptRetrieveForMediaCarousel::class, OperationSha256Enum::conceptRetrieveForMediaCarousel);
        $locator->set(RequestConceptRetrieveForAccessibilityFeatures::class, OperationSha256Enum::conceptRetrieveForAccessibilityFeatures);
        $locator->set(RequestConceptRetrieveForMedia::class, OperationSha256Enum::conceptRetrieveForMedia);
        $locator->set(RequestWcaConceptRetrieveForLegalText::class, OperationSha256Enum::wcaConceptRetrieveForLegalText);

        return $locator;
    }

    public function set(string $requestClassName, BackedEnum $enum): self
    {
        $this->request[$requestClassName] = $enum;

        return $this;
    }

    /**
     * @throws RequestNotFoundException
     */
    public function get(string $requestClassName): BackedEnum
    {
        if (array_key_exists($requestClassName, $this->request)) {
            return $this->request[$requestClassName];
        }

        throw new RequestNotFoundException($requestClassName . ' not found in request locator');
    }

}
