<?php

declare(strict_types=1);

namespace PlaystationStoreApi\Enum;

enum OperationSha256Enum: string
{
    case categoryGridRetrieve = '4ce7d410a4db2c8b635a48c1dcec375906ff63b19dadd87e073f8fd0c0481d35';

    case featuresRetrieve = '010870e8b9269c5bcf06b60190edbf5229310d8fae5b86515ad73f05bd11c4d1';

    case metGetProductById = 'a128042177bd93dd831164103d53b73ef790d56f51dae647064cb8f9d9fc9d1a';

    case metGetAddOnsByTitleId = 'e98d01ff5c1854409a405a5f79b5a9bcd36a5c0679fb33f4e18113c157d4d916';

    case metGetConceptByProductIdQuery = '0a4c9f3693b3604df1c8341fdc3e481f42eeecf961a996baaa65e65a657a6433';

    case metGetConceptById = 'cc90404ac049d935afbd9968aef523da2b6723abfb9d586e5f77ebf7c5289006';

    case metGetPricingDataByConceptId = 'abcb311ea830e679fe2b697a27f755764535d825b24510ab1239a4ca3092bd09';

    case wcaProductStarRatingRetrive = 'cedd370c39e89da20efa7b2e55710e88cb6e6843cc2f8203f7e73ba4751e7253';

    case wcaConceptStarRatingRetrive = 'e12dc5cef72296a437b4d71e0b130010bf3707ab981b585ba00d1d5773ce2092';

    case conceptRetrieveForGameInfo = '156bf37e6d6091b4d584ebf5f430a65e818b6120525dd82a0745352d21619da6';

    case conceptRetrieveForGameTitle = 'd244286e38044363f1fb6707f719d41558c74542fc421503a38124ca87068812';

    case conceptRetrieveForCompatibilityNotices = 'fb1a981a21d7a00ba72bd79d3998044d77207687a5aa1d3a17d90d7b7f3acb05';

    case conceptRetrieveForContentRating = 'b504e0bc68af3dc08bc56c0001b27da26ed15d70827420f80805b2d031a95aa8';
}
