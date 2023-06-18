.PHONY: build get_catalog_ps4 get_catalog_ps5 ps_plus_deluxe ps_plus_extra ps_plus_essential get_product_by_id get_concept_by_id get_concept_by_product_id run_example

build:
	docker compose build php\
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

run_example:
	docker compose run --rm php -f examples/${name}.php > response/${name}.json


