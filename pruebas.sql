PGDMP                         {            pruebas    11.20    11.20     �
           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �
           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                        0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false                       1262    16393    pruebas    DATABASE     �   CREATE DATABASE pruebas WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Colombia.1252' LC_CTYPE = 'Spanish_Colombia.1252';
    DROP DATABASE pruebas;
             postgres    false            �            1259    16422    usuarios    TABLE     �   CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    telefono character varying(15),
    correo character varying(255) NOT NULL
);
    DROP TABLE public.usuarios;
       public         postgres    false            �            1259    16420    usuarios_id_seq    SEQUENCE     �   CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.usuarios_id_seq;
       public       postgres    false    197                       0    0    usuarios_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;
            public       postgres    false    196            ~
           2604    16425    usuarios id    DEFAULT     j   ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    196    197            �
          0    16422    usuarios 
   TABLE DATA               @   COPY public.usuarios (id, nombre, telefono, correo) FROM stdin;
    public       postgres    false    197   �
                  0    0    usuarios_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.usuarios_id_seq', 6, true);
            public       postgres    false    196            �
           2606    16430    usuarios usuarios_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public         postgres    false    197            �
   �   x�U��
�@�ϳO�O ��QoE��&y�.����B�N�z_,�u�����\Hp��HsSͳ��'g��7�u�j�4�0��j04�^zV�q���4#v4Cet�`��	�d �yѣZ0��M��Uk����4F)�ܖ�a��bk�&DB\\詈��}��\�������Eyk�Cl     