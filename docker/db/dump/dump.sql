-- public.abilities definition

-- Drop table

-- DROP TABLE public.abilities;

CREATE TABLE public.abilities (
	abt_id int8 NOT NULL,
	abt_name varchar(255) NOT NULL,
	abt_url varchar(255) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT abilities_pkey PRIMARY KEY (abt_id)
);

-- public.tbusers definition

-- Drop table

-- DROP TABLE public.tbusers;

CREATE TABLE public.tbusers (
	id bigserial NOT NULL,
	"name" varchar(255) NOT NULL,
	login varchar(255) NOT NULL,
	"password" varchar(255) NOT NULL,
	created_at timestamp(0) NULL DEFAULT(now()),
	updated_at timestamp(0) NULL,
	CONSTRAINT tbusers_login_unique UNIQUE (login),
	CONSTRAINT tbusers_pkey PRIMARY KEY (id)
);

INSERT INTO tbusers("name", "login", "password") 
VALUES('Padrão', 'default', '$2a$10$TeboNsSDle1cfYDcd4bj1epNLmuCfYIsrzyx3oBlepRtpnyda8fqi');

-- public.failed_jobs definition

-- Drop table

-- DROP TABLE public.failed_jobs;

CREATE TABLE public.failed_jobs (
	id bigserial NOT NULL,
	uuid varchar(255) NOT NULL,
	"connection" text NOT NULL,
	queue text NOT NULL,
	payload text NOT NULL,
	"exception" text NOT NULL,
	failed_at timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT failed_jobs_pkey PRIMARY KEY (id),
	CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid)
);

-- public.migrations definition

-- Drop table

-- DROP TABLE public.migrations;

CREATE TABLE public.migrations (
	id serial4 NOT NULL,
	migration varchar(255) NOT NULL,
	batch int4 NOT NULL,
	CONSTRAINT migrations_pkey PRIMARY KEY (id)
);

-- public.password_resets definition

-- Drop table

-- DROP TABLE public.password_resets;

CREATE TABLE public.password_resets (
	email varchar(255) NOT NULL,
	"token" varchar(255) NOT NULL,
	created_at timestamp(0) NULL
);
CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);

-- public.pokemons definition

-- Drop table

-- DROP TABLE public.pokemons;

CREATE TABLE public.pokemons (
	pkm_id int8 NOT NULL,
	pkm_name varchar(255) NOT NULL,
	pkm_species varchar(255) NOT NULL,
	pkm_base_experience int4 NOT NULL,
	pkm_height int4 NOT NULL,
	pkm_weight int4 NOT NULL,
	pkm_image varchar(255) NOT NULL,
	pkm_url varchar(255) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT pokemons_pkey PRIMARY KEY (pkm_id)
);

-- public.pokemon_types definition

-- Drop table

-- DROP TABLE public.pokemon_types;

CREATE TABLE public.pokemon_types (
	pkm_typ_id int8 NOT NULL,
	pkm_typ_name varchar(255) NOT NULL,
	pkm_typ_url varchar(255) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT pokemon_types_pkey PRIMARY KEY (pkm_typ_id)
);

-- public.sessions definition

-- Drop table

-- DROP TABLE public.sessions;

CREATE TABLE public.sessions (
	id varchar(255) NOT NULL,
	user_id int8 NULL,
	ip_address varchar(45) NULL,
	user_agent text NULL,
	payload text NOT NULL,
	last_activity int4 NOT NULL,
	CONSTRAINT sessions_pkey PRIMARY KEY (id)
);
CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


-- public.pokemon_abilities definition

-- Drop table

-- DROP TABLE public.pokemon_abilities;

CREATE TABLE public.pokemon_abilities (
	pkm_abt_id bigserial NOT NULL,
	pkm_abt_pokemon int8 NOT NULL,
	pkm_abt_abilities int8 NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT pokemon_abilities_pkey PRIMARY KEY (pkm_abt_id)
);


-- public.pokemon_abilities foreign keys

ALTER TABLE public.pokemon_abilities ADD CONSTRAINT pokemon_abilities_pkm_abt_abilities_foreign FOREIGN KEY (pkm_abt_abilities) REFERENCES public.abilities(abt_id);
ALTER TABLE public.pokemon_abilities ADD CONSTRAINT pokemon_abilities_pkm_abt_pokemon_foreign FOREIGN KEY (pkm_abt_pokemon) REFERENCES public.pokemons(pkm_id);

-- public.pokemon_types_pokemons definition

-- Drop table

-- DROP TABLE public.pokemon_types_pokemons;

CREATE TABLE public.pokemon_types_pokemons (
	typ_pkm_id bigserial NOT NULL,
	typ_pkm_pokemon int8 NOT NULL,
	typ_pkm_type int8 NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT pokemon_types_pokemons_pkey PRIMARY KEY (typ_pkm_id)
);


-- public.pokemon_types_pokemons foreign keys

ALTER TABLE public.pokemon_types_pokemons ADD CONSTRAINT pokemon_types_pokemons_typ_pkm_pokemon_foreign FOREIGN KEY (typ_pkm_pokemon) REFERENCES public.pokemons(pkm_id);
ALTER TABLE public.pokemon_types_pokemons ADD CONSTRAINT pokemon_types_pokemons_typ_pkm_type_foreign FOREIGN KEY (typ_pkm_type) REFERENCES public.pokemon_types(pkm_typ_id);

-- public.tbpokemons definition

-- Drop table

-- DROP TABLE public.tbpokemons;

CREATE TABLE public.tbpokemons (
	id bigserial NOT NULL,
	"index" int4 NOT NULL,
	id_user int8 NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT tbpokemons_pkey PRIMARY KEY (id)
);


-- public.tbpokemons foreign keys

ALTER TABLE public.tbpokemons ADD CONSTRAINT tbpokemons_id_user_foreign FOREIGN KEY (id_user) REFERENCES public.tbusers(id) ON DELETE CASCADE;