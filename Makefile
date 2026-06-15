.PHONY: build get_catalog_ps4 get_catalog_ps5 ps_plus_deluxe ps_plus_extra ps_plus_essential get_product_by_id get_concept_by_id get_concept_by_product_id get_concept_for_game_info get_concept_for_game_title get_concept_for_compatibility_notices concept_retrieve_for_content_rating concept_retrieve_for_media_carousel concept_retrieve_for_accessibility_features wca_concept_retrieve_for_legal_text run_example lint lint-fix

build:
	docker compose build php \
	&& docker compose run --rm php composer install -n

get_catalog_ps4:
	make run_example name=get_catalog_ps4

get_catalog_ps5:
	make run_example name=get_catalog_ps5

get_catalog_pagination_next_page:
	make run_example name=get_catalog_pagination_next_page

get_catalog_pagination_last_page:
	make run_example name=get_catalog_pagination_last_page

ps_plus_deluxe:
	make run_example name=ps_plus_deluxe

ps_plus_extra:
	make run_example name=ps_plus_extra

ps_plus_essential:
	make run_example name=ps_plus_extra

get_product_by_id:
	make run_example name=get_product_by_id

get_concept_by_id:
	make run_example name=get_concept_by_id

get_concept_by_product_id:
	make run_example name=get_concept_by_product_id

get_pricing_data_by_concept_id:
	make run_example name=get_pricing_data_by_concept_id

get_add_ons_by_title_id:
	make run_example name=get_add_ons_by_title_id

get_product_star_rating:
	make run_example name=get_product_star_rating

get_concept_star_rating:
	make run_example name=get_concept_star_rating

get_concept_for_game_info:
	make run_example name=get_concept_for_game_info

get_concept_for_game_title:
	make run_example name=get_concept_for_game_title

get_concept_for_compatibility_notices:
	make run_example name=get_concept_for_compatibility_notices

concept_retrieve_for_content_rating:
	make run_example name=concept_retrieve_for_content_rating

concept_retrieve_for_media_carousel:
	make run_example name=concept_retrieve_for_media_carousel

concept_retrieve_for_accessibility_features:
	make run_example name=concept_retrieve_for_accessibility_features

wca_concept_retrieve_for_legal_text:
	make run_example name=wca_concept_retrieve_for_legal_text

run_example:
	docker compose run --rm php -f ${name}.php > response/${name}.json

lint:
	docker compose run --rm -w /app php sh -lc "composer install -n --prefer-dist && composer lint"

lint-fix:
	docker compose run --rm -w /app php sh -lc "composer install -n --prefer-dist && composer lint-fix"


