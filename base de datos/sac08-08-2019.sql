--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.17
-- Dumped by pg_dump version 9.5.17

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: unaccent; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS unaccent WITH SCHEMA public;


--
-- Name: EXTENSION unaccent; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION unaccent IS 'text search dictionary that removes accents';


--
-- Name: busqueda_cite_especifico(character varying, integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.busqueda_cite_especifico(cite character varying, tipo_doc integer, anio integer) RETURNS TABLE(id_documento integer, codigo_cite text, destinatario text, cargo_destinatario text, referencia text, fecha date, autor text, remitente_nombres text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

		SELECT 
		d.id_documento,
		COALESCE(NULLIF(d.codigo::text,''),'S/D') codigo_cite,
		COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
		COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF(d.referencia::text,''),'S/D') referencia,
		COALESCE(NULLIF(d.fecha::DATE,'1000-01-01'),null) fecha,
		COALESCE(NULLIF((select u.nombre from usuarios u where u.id_usuario=d.fk_usuario ),''),'S/N') as autor,
		COALESCE(NULLIF(d.remitente_nombres::text,''),'S/D') remitente_nombres
		FROM documentos d
		WHERE d.activo=1 
			-- AND d.fk_estado_documento=2
			AND d.fk_tipo_documento=tipo_doc
			AND d.gestion=anio
			AND codigo LIKE ('%'||cite||'%')
		ORDER BY d.id_documento DESC
 ;

END;
$$;


ALTER FUNCTION public.busqueda_cite_especifico(cite character varying, tipo_doc integer, anio integer) OWNER TO alvaro;

--
-- Name: busqueda_nombre_remitente_especifico(character varying, integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.busqueda_nombre_remitente_especifico(nombre character varying, tipo_doc integer, anio integer) RETURNS TABLE(id_documento integer, codigo_cite text, destinatario text, cargo_destinatario text, referencia text, institucion_remitente text, remitente_nombres text, remitente_cargo text, fecha date, autor text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
-- se habilita para que busque en palabras con acento y sin acento
--CREATE EXTENSION unaccent;
return query

		SELECT 
		d.id_documento,
		COALESCE(NULLIF(d.codigo::text,''),'S/D') codigo_cite,
		COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
		COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF(d.referencia::text,''),'S/D') referencia,
		COALESCE(NULLIF(d.remitente_institucion::text,''),'S/D') institucion_remitente,
		COALESCE(NULLIF(d.remitente_nombres::text,''),'S/D') remitente_nombres,
		COALESCE(NULLIF(d.remitente_cargo::text,''),'S/D') remitente_cargo,
		COALESCE(NULLIF(d.fecha::DATE,'1000-01-01'),null) fecha,
		COALESCE(NULLIF((select u.nombre from usuarios u where u.id_usuario=d.fk_usuario ),''),'S/N') as autor
		FROM documentos d
		WHERE d.activo=1 
			-- AND d.fk_estado_documento=2

			AND d.fk_tipo_documento=tipo_doc
			AND d.gestion=anio
			AND unaccent(d.remitente_nombres) ILIKE unaccent('%'||nombre||'%')
		ORDER BY d.id_documento DESC
 ;

END;
$$;


ALTER FUNCTION public.busqueda_nombre_remitente_especifico(nombre character varying, tipo_doc integer, anio integer) OWNER TO alvaro;

--
-- Name: busqueda_nuri(character varying, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.busqueda_nuri(nuri character varying, ofi integer) RETURNS TABLE(id_seguimiento integer, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, oficial integer, fk_estado integer, numero_copia character varying, accion_archivo text, copia_padre text, confirmado integer)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT s.id_seguimiento,
				COALESCE(NULLIF((select (a.cite||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.cite||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,

				s.oficial,
				s.fk_estado,
				s.numero_copia,
				s.accion_archivo,
				
				COALESCE(NULLIF((select e.numero_copia from seguimientos e where e.id_seguimiento=s.padre ),''),'0') as copia_padre,
				s.confirmado
            
FROM seguimientos s
WHERE s.activo=1 AND s.codigo=nuri AND s.oficial=ofi ORDER BY s.id_seguimiento ASC
 ;

END;
$$;


ALTER FUNCTION public.busqueda_nuri(nuri character varying, ofi integer) OWNER TO alvaro;

--
-- Name: busqueda_nuri_pag_web(character varying); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.busqueda_nuri_pag_web(nuri character varying) RETURNS TABLE(id_seguimiento integer, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, oficial integer, fk_estado integer, numero_copia character varying, accion_archivo text, copia_padre text, confirmado integer)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT s.id_seguimiento,
				COALESCE(NULLIF((select (a.cite||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.cite||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,

				s.oficial,
				s.fk_estado,
				s.numero_copia,
				s.accion_archivo,
				
				COALESCE(NULLIF((select e.numero_copia from seguimientos e where e.id_seguimiento=s.padre ),''),'0') as copia_padre,
				s.confirmado
            
FROM seguimientos s
WHERE s.activo=1 AND s.codigo=nuri ORDER BY s.id_seguimiento ASC
 ;

END;
$$;


ALTER FUNCTION public.busqueda_nuri_pag_web(nuri character varying) OWNER TO alvaro;

--
-- Name: busqueda_referencia_especifico(character varying, integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.busqueda_referencia_especifico(refer character varying, tipo_doc integer, anio integer) RETURNS TABLE(id_documento integer, codigo_cite text, destinatario text, cargo_destinatario text, referencia text, fecha date, autor text, remitente_nombres text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
-- se habilita para que busque en palabras con acento y sin acento
-- se ejecuta CREATE EXTENSION unaccent; como consulta una sola vez 
-- CREATE EXTENSION unaccent;
return query



		SELECT 
		d.id_documento,
		COALESCE(NULLIF(d.codigo::text,''),'S/D') codigo_cite,
		COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
		COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF(d.referencia::text,''),'S/D') referencia,
		COALESCE(NULLIF(d.fecha::DATE,'1000-01-01'),null) fecha,
		COALESCE(NULLIF((select u.nombre from usuarios u where u.id_usuario=d.fk_usuario ),''),'S/N') as autor,
		COALESCE(NULLIF(d.remitente_nombres::text,''),'S/D') remitente_nombres
		FROM documentos d
		WHERE d.activo=1 
			-- AND d.fk_estado_documento=2

			AND d.fk_tipo_documento=tipo_doc
			AND d.gestion=anio
			AND  unaccent(d.referencia) ILIKE unaccent('%'||refer||'%')
			-- AND  to_ascii(d.referencia,'LATIN1') ILIKE to_ascii('%'||refer||'%','LATIN1')
			-- AND  to_ascii(d.referencia) ILIKE to_ascii('%refer%')
		ORDER BY d.id_documento DESC
 ;

END;
$$;


ALTER FUNCTION public.busqueda_referencia_especifico(refer character varying, tipo_doc integer, anio integer) OWNER TO alvaro;

--
-- Name: busqueda_remitente_especifico(character varying, integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.busqueda_remitente_especifico(institucion character varying, tipo_doc integer, anio integer) RETURNS TABLE(id_documento integer, codigo_cite text, destinatario text, cargo_destinatario text, referencia text, institucion_remitente text, fecha date, autor text, remitente_nombres text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
-- se habilita para que busque en palabras con acento y sin acento
-- CREATE EXTENSION unaccent;
-- ///////////////
return query

		SELECT 
		d.id_documento,
		COALESCE(NULLIF(d.codigo::text,''),'S/D') codigo_cite,
		COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
		COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF(d.referencia::text,''),'S/D') referencia,
		COALESCE(NULLIF(d.remitente_institucion::text,''),'S/D') institucion_remitente,
		COALESCE(NULLIF(d.fecha::DATE,'1000-01-01'),null) fecha,
		COALESCE(NULLIF((select u.nombre from usuarios u where u.id_usuario=d.fk_usuario ),''),'S/N') as autor,
		COALESCE(NULLIF(d.remitente_nombres::text,''),'S/D') remitente_nombres
		FROM documentos d
		WHERE d.activo=1 
			-- AND d.fk_estado_documento=2

			AND d.fk_tipo_documento=tipo_doc
			AND d.gestion=anio
			AND unaccent(d.remitente_institucion) ILIKE unaccent('%'||institucion||'%')
		ORDER BY d.id_documento DESC
 ;

END;
$$;


ALTER FUNCTION public.busqueda_remitente_especifico(institucion character varying, tipo_doc integer, anio integer) OWNER TO alvaro;

--
-- Name: busqueda_sintesis_especifico(character varying, integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.busqueda_sintesis_especifico(sintesis character varying, tipo_doc integer, anio integer) RETURNS TABLE(id_documento integer, codigo_cite text, destinatario text, cargo_destinatario text, referencia text, institucion_remitente text, remitente_nombres text, remitente_cargo text, contenido text, fecha date, autor text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
-- se habilita para que busque en palabras con acento y sin acento
-- CREATE EXTENSION unaccent;
-- ///////////////
return query

		SELECT 
		d.id_documento,
		COALESCE(NULLIF(d.codigo::text,''),'S/D') codigo_cite,
		COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
		COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF(d.referencia::text,''),'S/D') referencia,
		COALESCE(NULLIF(d.remitente_institucion::text,''),'S/D') institucion_remitente,
		COALESCE(NULLIF(d.remitente_nombres::text,''),'S/D') remitente_nombres,
		COALESCE(NULLIF(d.remitente_cargo::text,''),'S/D') remitente_cargo,
		COALESCE(NULLIF(d.contenido::text,''),'S/D') contenido,
		COALESCE(NULLIF(d.fecha::DATE,'1000-01-01'),null) fecha,
		COALESCE(NULLIF((select u.nombre from usuarios u where u.id_usuario=d.fk_usuario ),''),'S/N') as autor
		FROM documentos d
		WHERE d.activo=1 
			-- AND d.fk_estado_documento=2

			AND d.fk_tipo_documento=tipo_doc
			AND d.gestion=anio
			AND unaccent(d.contenido) ILIKE unaccent('%'||sintesis||'%')
		ORDER BY d.id_documento DESC
 ;

END;
$$;


ALTER FUNCTION public.busqueda_sintesis_especifico(sintesis character varying, tipo_doc integer, anio integer) OWNER TO alvaro;

--
-- Name: cabecera_seguimiento(character varying); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.cabecera_seguimiento(nuri character varying) RETURNS TABLE(tipo_doc text, cite text, referencia text, remitente text, rem_institucion text, destinatario text, dest_institucion text, adjunto text, fecha_creacion date, hora_creacion time without time zone, id_doc integer)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT
				COALESCE(NULLIF((select t.tipo_documento from documentos d, tipo_documento t where d.id_documento=h.fk_documento and d.fk_tipo_documento=t.id_tipo_documento and d.activo=1),''),'S/N') as tipo_doc,
				COALESCE(NULLIF((select d.codigo from documentos d where d.id_documento=h.fk_documento and d.activo=1),''),'S/N') as cite,
				COALESCE(NULLIF((select d.referencia from documentos d where d.id_documento=h.fk_documento and activo=1),''),'S/N') as referencia,
				COALESCE(NULLIF((select (d.remitente_nombres||' - '||d.remitente_cargo) from documentos d where d.id_documento=h.fk_documento and activo=1),''),'S/N') as remitente,
				COALESCE(NULLIF((select d.remitente_institucion from documentos d where d.id_documento=h.fk_documento and activo=1),''),'S/N') as rem_institucion,
				COALESCE(NULLIF((select (d.destinatario_nombres||' - '||d.destinatario_cargo) from documentos d where d.id_documento=h.fk_documento and activo=1),''),'S/N') as destinatario,
				COALESCE(NULLIF((select d.destinatario_institucion from documentos d where d.id_documento=h.fk_documento and activo=1),''),'S/N') as dest_institucion,
				COALESCE(NULLIF((select d.adjuntos from documentos d where d.id_documento=h.fk_documento and activo=1),''),'S/N') as adjunto,		
				COALESCE(NULLIF((select d.fecha from documentos d where d.id_documento=h.fk_documento and d.activo=1)::DATE,'1000-01-01'),null) as fecha_creacion,
				COALESCE(NULLIF((select d.hora from documentos d where d.id_documento=h.fk_documento and activo=1)::TIME,'00:00:00'),null) as hora_creacion,
				fk_documento as id_doc
							
            
FROM hojas_ruta h 
WHERE h.activo=1 AND h.nro=0 AND h.nur=nuri
 ;

END;
$$;


ALTER FUNCTION public.cabecera_seguimiento(nuri character varying) OWNER TO alvaro;

--
-- Name: cites_area(integer, integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.cites_area(area integer, tipo_documento integer, anio integer) RETURNS TABLE(id_documento integer, id_tipo_documento integer, cite text, destinatario text, cargo_destinatario text, refer text, fecha_creacion date, tipo_doc text, estado_doc text, autor text, cargo_autor text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT 
		d.id_documento,
		d.fk_tipo_documento as id_tipo_documento,
		-- COALESCE(NULLIF(h.nur::text,''),'S/D') nuri,
			
		COALESCE(NULLIF(d.codigo::text,''),'S/D') cite,
		COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
		COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF(d.referencia::text,''),'S/D') refer,
		COALESCE(NULLIF(d.fecha::date,'1000-01-01'),null) fecha_creacion,
		COALESCE(NULLIF((select t.tipo_documento from tipo_documento t where d.fk_tipo_documento=t.id_tipo_documento and t.activo=1 )::text,''),'S/D') tipo_doc,
		COALESCE(NULLIF((select e.estado_documento from estado_documento e where d.fk_estado_documento=e.id_estado_documento and e.activo=1 )::text,''),'S/D') estado_doc,
		COALESCE(NULLIF((select u.nombre from usuarios u where d.fk_usuario=u.id_usuario )::text,''),'S/D') autor,
		COALESCE(NULLIF((select u.cargo from usuarios u where d.fk_usuario=u.id_usuario )::text,''),'S/D') cargo_autor


		FROM documentos d
		WHERE d.activo=1 
			AND d.fk_area=area
			AND d.fk_tipo_documento=tipo_documento
			AND d.gestion=anio
		ORDER BY d.id_documento DESC

;
END;
$$;


ALTER FUNCTION public.cites_area(area integer, tipo_documento integer, anio integer) OWNER TO alvaro;

--
-- Name: cites_asignados(integer, integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.cites_asignados(area integer, t_documento integer, anio integer) RETURNS TABLE(id_documento integer, id_tipo_documento integer, nuri character varying, cite text, destinatario text, cargo_destinatario text, refer text, fecha_creacion date, tipo_doc text, estado_doc text, autor text, cargo_autor text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

		SELECT 
		d.id_documento,
		d.fk_tipo_documento as id_tipo_documento,
		h.nur as nuri,
		-- COALESCE(NULLIF(h.nur::text,''),'S/D') nuri,
			
		COALESCE(NULLIF(d.codigo::text,''),'S/D') cite,
		COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
		COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF(d.referencia::text,''),'S/D') refer,
		COALESCE(NULLIF(d.fecha::date,'1000-01-01'),null) fecha_creacion,
		COALESCE(NULLIF((select t.tipo_documento from tipo_documento t where d.fk_tipo_documento=t.id_tipo_documento and t.activo=1 )::text,''),'S/D') tipo_doc,
		COALESCE(NULLIF((select e.estado_documento from estado_documento e where d.fk_estado_documento=e.id_estado_documento and e.activo=1 )::text,''),'S/D') estado_doc,
		COALESCE(NULLIF((select u.nombre from usuarios u where d.fk_usuario=u.id_usuario )::text,''),'S/D') autor,
		COALESCE(NULLIF((select u.cargo from usuarios u where d.fk_usuario=u.id_usuario )::text,''),'S/D') cargo_autor


		FROM documentos d, hojas_ruta h
		WHERE d.activo=1 
			AND d.fk_area=area
			AND d.fk_tipo_documento=t_documento
			AND d.gestion=anio
			AND d.id_documento=h.fk_documento
		ORDER BY d.id_documento DESC
 ;

END;
$$;


ALTER FUNCTION public.cites_asignados(area integer, t_documento integer, anio integer) OWNER TO alvaro;

--
-- Name: derivaciones_digitales(character varying, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.derivaciones_digitales(nuri character varying, id_nuri_padre integer) RETURNS TABLE(usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text, id_seg integer)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT



				
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento,
				s.id_seguimiento as id_seg			
            
FROM seguimientos s
WHERE s.activo=1 AND s.codigo=nuri AND s.padre=id_nuri_padre ORDER BY s.id_seguimiento ASC
 ;

END;
$$;


ALTER FUNCTION public.derivaciones_digitales(nuri character varying, id_nuri_padre integer) OWNER TO alvaro;

--
-- Name: derivaciones_seguimiento(character varying, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.derivaciones_seguimiento(nuri character varying, id_nuri_padre integer) RETURNS TABLE(usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text, nombre_grupo text, numero_copia character varying, oficial integer, id_seguimiento integer, padre integer)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT	
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN s.oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento,

				 (CASE WHEN s.fk_grupo_derivacion=0 THEN
                 'S/D' 
         ELSE
                 COALESCE(NULLIF((select g.nombre_grupo from grupo_derivacion g where g.id_grupo_derivacion=s.fk_grupo_derivacion ),''),'S/N') 
         END ) as nombre_grupo,
				s.numero_copia,
				s.oficial,
				s.id_seguimiento,
				s.padre					
            
FROM seguimientos s
WHERE s.activo=1 AND s.confirmado=0 AND s.codigo=nuri AND s.padre=id_nuri_padre ORDER BY s.oficial DESC, s.correlativo_copia ASC, s.id_seguimiento ASC
 ;

END;
$$;


ALTER FUNCTION public.derivaciones_seguimiento(nuri character varying, id_nuri_padre integer) OWNER TO alvaro;

--
-- Name: derivaciones_seguimiento_nuevo(character varying); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.derivaciones_seguimiento_nuevo(nuri character varying) RETURNS TABLE(usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text, nombre_grupo text, numero_copia character varying, oficial integer, id_seguimiento integer)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT	
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN s.oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento,

				 (CASE WHEN s.fk_grupo_derivacion=0 THEN
                 'S/D' 
         ELSE
                 COALESCE(NULLIF((select g.nombre_grupo from grupo_derivacion g where g.id_grupo_derivacion=s.fk_grupo_derivacion ),''),'S/N') 
         END ) as nombre_grupo,
				s.numero_copia,
				s.oficial,
				s.id_seguimiento							
            
FROM seguimientos s
WHERE s.activo=1 AND s.codigo=nuri AND s.padre=0 AND s.confirmado=0 ORDER BY s.oficial DESC, s.correlativo_copia ASC, s.id_seguimiento ASC
 ;

END;
$$;


ALTER FUNCTION public.derivaciones_seguimiento_nuevo(nuri character varying) OWNER TO alvaro;

--
-- Name: derivados_no_recibidos(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.derivados_no_recibidos(usuario integer) RETURNS TABLE(id_seguimiento integer, nuri character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT
				s.id_seguimiento,
				codigo as nuri,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento						
            
FROM seguimientos s
WHERE s.activo=1 AND s.fk_estado=3 AND s.confirmado=1 AND s.derivado_por=usuario ORDER BY s.oficial, s.codigo ASC
 ;

END;
$$;


ALTER FUNCTION public.derivados_no_recibidos(usuario integer) OWNER TO alvaro;

--
-- Name: derivados_no_recibidos_copy(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.derivados_no_recibidos_copy(usuario integer) RETURNS TABLE(nuri character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT
				codigo as nuri,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento						
            
FROM seguimientos s
WHERE s.activo=1 AND s.fk_estado=3 AND s.confirmado=1 AND s.derivado_por=usuario ORDER BY s.oficial, s.fecha_derivacion ASC
 ;

END;
$$;


ALTER FUNCTION public.derivados_no_recibidos_copy(usuario integer) OWNER TO alvaro;

--
-- Name: derivados_no_recibidos_externo(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.derivados_no_recibidos_externo(usuario integer) RETURNS TABLE(nuri character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT
				s.codigo as nuri,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN s.oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento						
            
FROM seguimientos s, hojas_ruta h, documentos d
WHERE s.activo=1 
AND s.fk_estado=3 
AND s.confirmado=1
AND s.derivado_por=usuario
AND s.codigo=h.nur
AND h.fk_documento=d.id_documento
AND d.fk_tipo_documento=7

ORDER BY s.oficial, s.codigo ASC
 ;

END;
$$;


ALTER FUNCTION public.derivados_no_recibidos_externo(usuario integer) OWNER TO alvaro;

--
-- Name: documentos_atendidos(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.documentos_atendidos(usuario integer) RETURNS TABLE(id_seguimiento integer, nuri character varying, numero_copia character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text, adjuntos text)
    LANGUAGE plpgsql
    AS $$

BEGIN
return query

		SELECT
		s.id_seguimiento,
		s.codigo nuri,
		s.numero_copia,                                                      
		COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
		COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
		COALESCE(NULLIF(s.proveido,''),'0') as proveido,
		COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
		COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
																		
		COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
		COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
		COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
		COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
			(CASE WHEN oficial=1 THEN
					 'ORIGINAL'
			 ELSE
					 'COPIA DIGITAL'
			 END ) as tipo_documento,

		COALESCE(NULLIF((SELECT 
										STRING_AGG (h.codigo,', ') AS cites
										FROM hojas_ruta AS h
										WHERE h.nro=s.id_seguimiento
										AND h.activo=1
										GROUP BY h.nro
										ORDER BY 1),''),'S/D') adjuntos


								
		FROM seguimientos s
		WHERE s.activo=1 AND s.derivado_por=usuario ORDER BY s.id_seguimiento ASC

;

END;
$$;


ALTER FUNCTION public.documentos_atendidos(usuario integer) OWNER TO alvaro;

--
-- Name: documentos_sin_nuri(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.documentos_sin_nuri(usuario integer) RETURNS TABLE(id_documento integer, id_tipo_documento integer, cite text, destinatario text, cargo_destinatario text, refer text, fecha_creacion date, tipo_doc text, estado_doc text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

		SELECT 
		d.id_documento,
		d.fk_tipo_documento as id_tipo_documento,
		
		COALESCE(NULLIF(codigo::text,''),'S/D') cite,
		COALESCE(NULLIF(destinatario_nombres::text,''),'S/D') destinatario,
		COALESCE(NULLIF(destinatario_cargo::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF(referencia::text,''),'S/D') refer,
		COALESCE(NULLIF(fecha::date,'1000-01-01'),null) fecha_creacion,
		COALESCE(NULLIF((select t.tipo_documento from tipo_documento t where d.fk_tipo_documento=t.id_tipo_documento and t.activo=1 )::text,''),'S/D') tipo_doc,
		COALESCE(NULLIF((select e.estado_documento from estado_documento e where d.fk_estado_documento=e.id_estado_documento and e.activo=1 )::text,''),'S/D') estado_doc


		FROM documentos d
		WHERE d.activo=1 
			AND d.fk_usuario=usuario AND d.fk_estado_documento!=7
			AND NOT d.id_documento in(select h.fk_documento from hojas_ruta h where h.activo=1) 
		ORDER BY d.id_documento ASC
 ;

END;
$$;


ALTER FUNCTION public.documentos_sin_nuri(usuario integer) OWNER TO alvaro;

--
-- Name: lista_carta_externa(character varying); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_carta_externa(nuri character varying) RETURNS TABLE(id_hoja_ruta integer, id_documento integer, nur character varying, codigo character varying, ruta_documento character varying)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT 
		h.id_hoja_ruta,
		h.fk_documento as id_documento,
		h.nur, 
		h.codigo,
		d.ruta_documento

FROM hojas_ruta h, documentos d
WHERE h.fk_documento=d.id_documento
AND d.fk_tipo_documento=7
AND h.activo=1 
AND h.fecha_registro>='2019-02-04'
AND h.nur=nuri 
ORDER BY h.id_hoja_ruta ASC;


END;
$$;


ALTER FUNCTION public.lista_carta_externa(nuri character varying) OWNER TO alvaro;

--
-- Name: lista_derivacion(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_derivacion(usuario_o integer) RETURNS TABLE(id_usuario_destino integer, nombre_destino character varying, nombre_regional character varying, nombre_area character varying)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

										SELECT usuario_destino as id_usuario_destino,
                      (SELECT u.nombre FROM usuarios u WHERE u.id_usuario=l.usuario_destino AND u.activo=1) nombre_destino,
                      (SELECT r.regional FROM usuarios u, regionales r WHERE u.fk_regional=r.id_regional AND  u.id_usuario=l.usuario_destino AND u.activo=1) nombre_regional,
											(SELECT 
													(CASE 
															WHEN u.fk_nivel=1 THEN                 
																	'S/N' 
															WHEN u.fk_nivel=3 THEN
																	'S/N' 
															ELSE
																a.area 
															END )
											 FROM usuarios u, areas a WHERE u.fk_area=a.id_area AND  u.id_usuario=l.usuario_destino AND u.activo=1 ) nombre_area	
                    FROM lista_derivacion l
                    WHERE l.usuario_origen=usuario_o AND l.activo=1
                    ORDER BY l.id_lista_derivacion ASC
 ;

END;
$$;


ALTER FUNCTION public.lista_derivacion(usuario_o integer) OWNER TO alvaro;

--
-- Name: lista_derivacion_area(integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_derivacion_area(area integer, usuario_o integer) RETURNS TABLE(id_funcionario integer, nombre_funcionario text, nombre_area text, nombre_regional text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT u.id_usuario,
				COALESCE(NULLIF(nombre,''),'S/N') as nombre_funcionario,
				(CASE 
							WHEN u.fk_nivel=1 THEN                 
									'S/N' 
							WHEN u.fk_nivel=3 THEN
									'S/N' 
							ELSE
								COALESCE(NULLIF((select a.area from areas a where u.fk_area=a.id_area ),''),'S/N') 
							END ) as nombre_area,
				COALESCE(NULLIF((select regional from regionales r where u.fk_regional=r.id_regional ),''),'S/N') as nombre_regional    
				FROM usuarios u
				WHERE fk_area=area AND u.activo=1  AND u.id_usuario!=usuario_o
				ORDER BY u.id_usuario ASC

 ;

END;
$$;


ALTER FUNCTION public.lista_derivacion_area(area integer, usuario_o integer) OWNER TO alvaro;

--
-- Name: lista_derivacion_nacional(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_derivacion_nacional(area integer) RETURNS TABLE(id_funcionario integer, nombre_funcionario text, nombre_area text, nombre_regional text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT u.id_usuario,
				COALESCE(NULLIF(nombre,''),'S/N') as nombre_funcionario,
				(CASE 
							WHEN u.fk_nivel=1 THEN                 
									'S/N' 
							WHEN u.fk_nivel=3 THEN
									'S/N' 
							ELSE
								COALESCE(NULLIF((select a.area from areas a where u.fk_area=a.id_area ),''),'S/N') 
							END ) as nombre_area,
				COALESCE(NULLIF((select regional from regionales r where u.fk_regional=r.id_regional ),''),'S/N') as nombre_regional    
				FROM usuarios u
				WHERE u.fk_nivel in (1,3) AND u.fk_area!=area AND u.activo=1
				ORDER BY u.id_usuario ASC

 ;

END;
$$;


ALTER FUNCTION public.lista_derivacion_nacional(area integer) OWNER TO alvaro;

--
-- Name: lista_derivacion_regional(integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_derivacion_regional(regional integer, usuario_o integer) RETURNS TABLE(id_funcionario integer, nombre_funcionario text, nombre_area text, nombre_regional text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT u.id_usuario,
				COALESCE(NULLIF(nombre,''),'S/N') as nombre_funcionario,
				(CASE 
							WHEN u.fk_nivel=1 THEN                 
									'S/N' 
							WHEN u.fk_nivel=3 THEN
									'S/N' 
							ELSE
								COALESCE(NULLIF((select a.area from areas a where u.fk_area=a.id_area ),''),'S/N') 
							END ) as nombre_area,
				COALESCE(NULLIF((select r.regional from regionales r where u.fk_regional=r.id_regional ),''),'S/N') as nombre_regional    
				FROM usuarios u
				WHERE fk_regional=regional AND fk_nivel!=3 AND u.id_usuario!=usuario_o AND u.activo=1
				ORDER BY u.id_usuario ASC

 ;

END;
$$;


ALTER FUNCTION public.lista_derivacion_regional(regional integer, usuario_o integer) OWNER TO alvaro;

--
-- Name: lista_nuris_agrupados(integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_nuris_agrupados(usuario integer, id_seg integer) RETURNS TABLE(id_agrupacion integer, nuri text, tipo_documento text, proveido text, fecha date, hora time without time zone)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT				
				a.id_agrupacion,
				COALESCE(NULLIF((select s.codigo from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1),''),'S/N') as nuri,

				(CASE WHEN (SELECT s.oficial FROM seguimientos s WHERE s.id_seguimiento=a.fk_seguimiento_hijo )=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento,
				COALESCE(NULLIF((select s.proveido from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1),''),'S/N') as proveido,
				(select s.fecha_derivacion from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1) f_derivacion,
				(select s.hora_derivacion from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1) h_derivacion

FROM agrupaciones a
WHERE a.activo=1 AND a.fk_seguimiento_padre=id_seg AND a.fk_usuario=usuario ORDER BY a.id_agrupacion ASC

;

END;
$$;


ALTER FUNCTION public.lista_nuris_agrupados(usuario integer, id_seg integer) OWNER TO alvaro;

--
-- Name: lista_nuris_agrupados_completo(character varying); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_nuris_agrupados_completo(nur character varying) RETURNS TABLE(id_agrupacion integer, nuri text, tipo_documento text, proveido text, fecha date, hora time without time zone, usuario_agrupacion text, fecha_agrupacion date)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT				
				a.id_agrupacion,
				COALESCE(NULLIF((select s.codigo from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1),''),'S/N') as nuri,

				(CASE WHEN (SELECT s.oficial FROM seguimientos s WHERE s.id_seguimiento=a.fk_seguimiento_hijo )=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento,
				COALESCE(NULLIF((select s.proveido from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1),''),'S/N') as proveido,
				(select s.fecha_derivacion from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1) f_derivacion,
				(select s.hora_derivacion from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1) h_derivacion,
				COALESCE(NULLIF((select u.nombre from usuarios u where u.id_usuario=a.fk_usuario),''),'S/N') usuario_agrupacion,
				fecha_registro fecha_agrupacion

FROM agrupaciones a
WHERE a.activo=1 AND a.nur_padre=nur ORDER BY a.id_agrupacion ASC

;

END;
$$;


ALTER FUNCTION public.lista_nuris_agrupados_completo(nur character varying) OWNER TO alvaro;

--
-- Name: lista_nuris_agrupados_sin_usuario(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_nuris_agrupados_sin_usuario(id_seg integer) RETURNS TABLE(id_agrupacion integer, nuri text, tipo_documento text, proveido text, fecha date, hora time without time zone, usuario_agrupacion text, fecha_agrupacion date)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT				
				a.id_agrupacion,
				COALESCE(NULLIF((select s.codigo from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1),''),'S/N') as nuri,

				(CASE WHEN (SELECT s.oficial FROM seguimientos s WHERE s.id_seguimiento=a.fk_seguimiento_hijo )=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento,
				COALESCE(NULLIF((select s.proveido from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1),''),'S/N') as proveido,
				(select s.fecha_derivacion from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1) f_derivacion,
				(select s.hora_derivacion from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and a.activo=1) h_derivacion,
				COALESCE(NULLIF((select u.nombre from usuarios u where u.id_usuario=a.fk_usuario),''),'S/N') usuario_agrupacion,
				fecha_registro fecha_agrupacion

FROM agrupaciones a
WHERE a.activo=1 AND a.fk_seguimiento_padre=id_seg ORDER BY a.id_agrupacion ASC

;

END;
$$;


ALTER FUNCTION public.lista_nuris_agrupados_sin_usuario(id_seg integer) OWNER TO alvaro;

--
-- Name: lista_nuris_creados(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_nuris_creados(usuario integer) RETURNS TABLE(nur character varying)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT DISTINCT	h.nur

FROM hojas_ruta h
WHERE h.activo=1 
		AND h.fk_usuario=usuario 
		AND h.nro=0 
		AND h.oficial=1 
		AND NOT h.nur in(select s.codigo from seguimientos s where s.activo=1) 
		ORDER BY h.nur ASC

;

END;
$$;


ALTER FUNCTION public.lista_nuris_creados(usuario integer) OWNER TO alvaro;

--
-- Name: lista_nuris_pendientes(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_nuris_pendientes(usuario integer) RETURNS TABLE(id_seguimiento integer, codigo character varying, codigo_completo text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT				
				s.id_seguimiento,
				s.codigo,
				( CASE WHEN s.oficial=1 THEN
                 (s.codigo||' ORIGINAL') 
              ELSE
                 (s.codigo||' COPIA DIGITAL') 
              END ) as codigo_completo

FROM seguimientos s
WHERE s.activo=1 AND s.derivado_a=usuario AND s.fk_estado in(1,2) ORDER BY s.oficial DESC, s.codigo ASC

;

END;
$$;


ALTER FUNCTION public.lista_nuris_pendientes(usuario integer) OWNER TO alvaro;

--
-- Name: lista_usuario_derivacion(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.lista_usuario_derivacion(usuarios integer) RETURNS TABLE(id_lista_derivacion integer, usuario_destino integer, nombre character varying, nombre_destino character varying, cargo_destino character varying, nombre_regional character varying, nombre_area text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT 
				l.id_lista_derivacion, 
				u.id_usuario usuario_destino, 
				u.nombre,
				(CASE 
					WHEN u.fk_nivel=1   THEN
						 COALESCE(NULLIF((select a.nombre from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 ),''),'S/N')
					WHEN u.fk_nivel=3   THEN
						 COALESCE(NULLIF((select a.nombre from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 ),''),'S/N') 
					ELSE
						 u.nombre
					END ) as nombre_destino,
				(CASE 
					WHEN u.fk_nivel=1   THEN
						 COALESCE(NULLIF((select a.cargo from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 ),''),'S/N')
					WHEN u.fk_nivel=3   THEN
						 COALESCE(NULLIF((select a.cargo from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 ),''),'S/N')  
					ELSE
						 u.cargo
					END ) as cargo_destino,
					(SELECT r.regional FROM regionales r WHERE u.fk_regional=r.id_regional) nombre_regional,

        (CASE 
						WHEN u.fk_nivel=1   THEN
								COALESCE(NULLIF((select a.nombre from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 ),''),'S/N')
						WHEN u.fk_nivel=3   THEN
								COALESCE(NULLIF((select a.nombre from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 ),''),'S/N')
						ELSE
							 COALESCE(NULLIF((SELECT a.area FROM areas a WHERE u.fk_area=a.id_area ),''),'S/N')
						END ) as nombre_area

			 FROM lista_derivacion l, usuarios u
			 WHERE l.usuario_origen=usuarios AND l.activo=1 AND l.usuario_destino=u.id_usuario AND u.activo=1
			 ORDER BY l.id_lista_derivacion ASC
 ;

END;
$$;


ALTER FUNCTION public.lista_usuario_derivacion(usuarios integer) OWNER TO alvaro;

--
-- Name: no_recibidos_usuario(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.no_recibidos_usuario(usuario integer) RETURNS TABLE(id_seguimiento integer, nuri character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT
				s.id_seguimiento,
				codigo as nuri,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento						
            
FROM seguimientos s
WHERE s.activo=1 AND s.fk_estado=3 AND s.confirmado=1 AND derivado_a=usuario ORDER BY s.oficial, s.fecha_derivacion ASC
 ;

END;
$$;


ALTER FUNCTION public.no_recibidos_usuario(usuario integer) OWNER TO alvaro;

--
-- Name: nur_externo_creado(integer, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.nur_externo_creado(usuario integer, anio integer) RETURNS TABLE(id_hoja_ruta integer, id_documento integer, nuri character varying, fecha date, cite text, destinatario text, cargo_destinatario text, remitente text, cargo_remitente text, remitente_institucion text, referencia text, estado_documento text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT 
		
				h.id_hoja_ruta,
				d.id_documento,
				h.nur as nuri,
				h.fecha,
				-- h.hora,
				COALESCE(NULLIF(d.codigo::text,''),'S/D') cite,
				COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
				COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
				COALESCE(NULLIF(d.remitente_nombres::text,''),'S/D') remitente,
				COALESCE(NULLIF(d.remitente_cargo::text,''),'S/D') cargo_remitente,
				COALESCE(NULLIF(d.remitente_institucion::text,''),'S/D') remitente_institucion,

				COALESCE(NULLIF(d.referencia::text,''),'S/D') referencia,
				-- COALESCE(NULLIF(d.fecha::date,'1000-01-01'),null) fecha_creacion,
				-- COALESCE(NULLIF((select t.tipo_documento from tipo_documento t where d.fk_tipo_documento=t.id_tipo_documento and t.activo=1 )::text,''),'S/D') tipo_documento,
				COALESCE(NULLIF((select e.estado_documento from estado_documento e where d.fk_estado_documento=e.id_estado_documento and e.activo=1 )::text,''),'S/D') estado_documento
				-- COALESCE(NULLIF((select u.nombre from usuarios u where d.fk_usuario=u.id_usuario )::text,''),'S/D') autor,
				-- COALESCE(NULLIF((select u.cargo from usuarios u where d.fk_usuario=u.id_usuario )::text,''),'S/D') cargo_autor

				FROM hojas_ruta h, documentos d
				WHERE h.activo=1 
					AND d.activo=1
					AND h.gestion=anio
					AND h.fk_usuario=usuario
					AND h.nro=0
					AND h.fk_documento=d.id_documento
					AND d.fk_tipo_documento=7
				ORDER BY h.fecha DESC
 ;

END;
$$;


ALTER FUNCTION public.nur_externo_creado(usuario integer, anio integer) OWNER TO alvaro;

--
-- Name: nuris_sin_derivar(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.nuris_sin_derivar(usuario integer) RETURNS TABLE(id_hoja_ruta integer, id_documento integer, nur character varying, codigo character varying, destinatario text, cargo_destinatario text, institucion_destinatario text, remitente text, cargo_remitente text, institucion_remitente text, referencia text, fecha date, tipo_documento text, id_tipo_documento integer)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

SELECT 
		h.id_hoja_ruta,
		h.fk_documento as id_documento,
		h.nur, 
		h.codigo,
		
		COALESCE(NULLIF((select d.destinatario_nombres from documentos d where d.id_documento=h.fk_documento and d.activo=1 )::text,''),'S/D') destinatario,
		COALESCE(NULLIF((select d.destinatario_cargo from documentos d where d.id_documento=h.fk_documento and d.activo=1 )::text,''),'S/D') cargo_destinatario,
		COALESCE(NULLIF((select d.destinatario_institucion from documentos d where d.id_documento=h.fk_documento and d.activo=1 )::text,''),'S/D') institucion_destinatario,

		COALESCE(NULLIF((select d.remitente_nombres from documentos d where d.id_documento=h.fk_documento and d.activo=1 )::text,''),'S/D') remitente,
		COALESCE(NULLIF((select d.remitente_cargo from documentos d where d.id_documento=h.fk_documento and d.activo=1 )::text,''),'S/D') cargo_remitente,
		COALESCE(NULLIF((select d.remitente_institucion from documentos d where d.id_documento=h.fk_documento and d.activo=1 )::text,''),'S/D') institucion_remitente,
		COALESCE(NULLIF((select d.referencia from documentos d where d.id_documento=h.fk_documento and d.activo=1 )::text,''),'S/D') referencia,
		COALESCE(NULLIF((select d.fecha from documentos d where d.id_documento=h.fk_documento and d.activo=1 )::date,'1000-01-01'),null) fecha,
		COALESCE(NULLIF((select t.tipo_documento from documentos d, tipo_documento t where d.id_documento=h.fk_documento and d.fk_tipo_documento=t.id_tipo_documento and d.activo=1 )::text,''),'S/D') tipo_documento,
		(select d.fk_tipo_documento from documentos d where d.id_documento=h.fk_documento and d.activo=1 ) id_tipo_documento


FROM hojas_ruta h
WHERE h.activo=1 
		AND h.fk_usuario=usuario 
		AND h.nro=0 
		AND h.oficial=1 
		AND NOT h.nur in(select s.codigo from seguimientos s where s.activo=1 and confirmado=1) 
		ORDER BY h.id_hoja_ruta ASC
;

END;
$$;


ALTER FUNCTION public.nuris_sin_derivar(usuario integer) OWNER TO alvaro;

--
-- Name: pendientes_area(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.pendientes_area(unidad integer) RETURNS TABLE(nuri character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT
				codigo as nuri,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento						
            
FROM seguimientos s, usuarios u
WHERE s.activo=1 AND s.fk_estado in (1,2) AND s.derivado_a=u.id_usuario AND u.fk_area=unidad ORDER BY u.id_usuario ASC
 ;

END;
$$;


ALTER FUNCTION public.pendientes_area(unidad integer) OWNER TO alvaro;

--
-- Name: pendientes_general(); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.pendientes_general() RETURNS TABLE(nuri character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text, unidad text, gerencia_regional text, estado_usuario text, usuario text, referencia text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT
				codigo as nuri,
				COALESCE(NULLIF((select (a.cite||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.cite||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento,
				 COALESCE(NULLIF((select area from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as unidad,
				 COALESCE(NULLIF((select regional from usuarios u, regionales r where u.id_usuario=s.derivado_a and u.fk_regional=r.id_regional ),''),'S/N') as gerencia_regional,
				 COALESCE(NULLIF((select (CASE WHEN activo=1 THEN 'ACTIVO' ELSE 'INACTIVO' END ) from usuarios u where u.id_usuario=s.derivado_a ),''),'S/N') as estado_usuario,
				 COALESCE(NULLIF((select u.usuario from usuarios u where u.id_usuario=s.derivado_a ),''),'S/N') as usuario,
			   COALESCE(NULLIF((select d.referencia from hojas_ruta h, documentos d where s.codigo=h.nur AND h.fk_documento= d.id_documento ORDER BY h.id_hoja_ruta ASC LIMIT 1 ),''),'S/N') as referencia
            
FROM seguimientos s
WHERE s.activo=1 AND fk_estado in (1,2) ORDER BY s.id_seguimiento ASC
 ;

END;
$$;


ALTER FUNCTION public.pendientes_general() OWNER TO alvaro;

--
-- Name: pendientes_oficiales_digitales(integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.pendientes_oficiales_digitales(usuario integer) RETURNS TABLE(nuri character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, tipo_documento text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT
				codigo as nuri,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,
				(CASE WHEN oficial=1 THEN
                 'ORIGINAL' 
         ELSE
                 'COPIA DIGITAL' 
         END ) as tipo_documento						
            
FROM seguimientos s
WHERE s.activo=1 AND fk_estado in (1,2) AND derivado_a=usuario ORDER BY s.oficial, s.fecha_derivacion  ASC
 ;

END;
$$;


ALTER FUNCTION public.pendientes_oficiales_digitales(usuario integer) OWNER TO alvaro;

--
-- Name: recibir_nuri(character varying, integer); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.recibir_nuri(nuri character varying, usuario integer) RETURNS TABLE(id_seguimiento integer, nur character varying, usuario_origen text, usuario_destino text, proveido text, f_derivacion date, h_derivacion time without time zone, f_recepcion date, h_recepcion time without time zone, accion text, estado text, oficial integer, fk_estado integer, numero_copia character varying, accion_archivo text, copia_padre text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT s.id_seguimiento, codigo nur,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_por and u.fk_area=a.id_area ),''),'S/N') as usuario_origen,
				COALESCE(NULLIF((select (a.sigla||': '||u.nombre) from usuarios u, areas a where u.id_usuario=s.derivado_a and u.fk_area=a.id_area ),''),'S/N') as usuario_destino,
				COALESCE(NULLIF(s.proveido,''),'0') as proveido,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				COALESCE(NULLIF((select a.accion from acciones a where a.id_accion=s.fk_accion ),''),'S/N') as accion,
				COALESCE(NULLIF((select e.estado from estados e where e.id_estado=s.fk_estado ),''),'S/N') as estado,

				s.oficial,
				s.fk_estado,
				s.numero_copia,
				s.accion_archivo,
				COALESCE(NULLIF((select e.numero_copia from seguimientos e where e.id_seguimiento=s.padre ),''),'0') as copia_padre
            
FROM seguimientos s
WHERE s.activo=1 AND s.fk_estado=3 AND s.codigo=nuri AND s.derivado_a=usuario ORDER BY s.id_seguimiento ASC
 ;

END;
$$;


ALTER FUNCTION public.recibir_nuri(nuri character varying, usuario integer) OWNER TO alvaro;

--
-- Name: reporte_nur_externo(integer, date, date); Type: FUNCTION; Schema: public; Owner: alvaro
--

CREATE FUNCTION public.reporte_nur_externo(usuario integer, inicio date, fin date) RETURNS TABLE(id_hoja_ruta integer, id_documento integer, nuri character varying, fecha date, cite text, destinatario text, cargo_destinatario text, remitente text, cargo_remitente text, remitente_institucion text, referencia text, sintesis text, estado_documento text)
    LANGUAGE plpgsql
    AS $$ 

BEGIN
return query

				SELECT 
		
				h.id_hoja_ruta,
				d.id_documento,
				h.nur as nuri,
				h.fecha,
				-- h.hora,
				COALESCE(NULLIF(d.codigo::text,''),'S/D') cite,
				COALESCE(NULLIF(d.destinatario_nombres::text,''),'S/D') destinatario,
				COALESCE(NULLIF(d.destinatario_cargo::text,''),'S/D') cargo_destinatario,
				COALESCE(NULLIF(d.remitente_nombres::text,''),'S/D') remitente,
				COALESCE(NULLIF(d.remitente_cargo::text,''),'S/D') cargo_remitente,
				COALESCE(NULLIF(d.remitente_institucion::text,''),'S/D') remitente_institucion,

				COALESCE(NULLIF(d.referencia::text,''),'S/D') referencia,
				COALESCE(NULLIF(d.contenido::text,''),'S/D') sintensis,
				-- COALESCE(NULLIF(d.fecha::date,'1000-01-01'),null) fecha_creacion,
				-- COALESCE(NULLIF((select t.tipo_documento from tipo_documento t where d.fk_tipo_documento=t.id_tipo_documento and t.activo=1 )::text,''),'S/D') tipo_documento,
				COALESCE(NULLIF((select e.estado_documento from estado_documento e where d.fk_estado_documento=e.id_estado_documento and e.activo=1 )::text,''),'S/D') estado_documento
				-- COALESCE(NULLIF((select u.nombre from usuarios u where d.fk_usuario=u.id_usuario )::text,''),'S/D') autor,
				-- COALESCE(NULLIF((select u.cargo from usuarios u where d.fk_usuario=u.id_usuario )::text,''),'S/D') cargo_autor

				FROM hojas_ruta h, documentos d
				WHERE h.activo=1 
					AND d.activo=1
					AND h.fecha>=inicio AND h.fecha<=fin
					AND h.fk_usuario=usuario
					AND h.nro=0
					AND h.fk_documento=d.id_documento
					AND d.fk_tipo_documento=7
				ORDER BY h.id_hoja_ruta ASC
 ;

END;
$$;


ALTER FUNCTION public.reporte_nur_externo(usuario integer, inicio date, fin date) OWNER TO alvaro;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: ActiveRecordLog; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public."ActiveRecordLog" (
    id integer NOT NULL,
    description character varying(255),
    action character varying(120),
    model character varying(145),
    idmodel integer,
    field character varying(145),
    creationdate timestamp without time zone NOT NULL,
    userid character varying(45),
    old_value character varying(2000),
    new_value character varying(2000)
);


ALTER TABLE public."ActiveRecordLog" OWNER TO geonode;

--
-- Name: ActiveRecordLog_id_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public."ActiveRecordLog_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."ActiveRecordLog_id_seq" OWNER TO geonode;

--
-- Name: ActiveRecordLog_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public."ActiveRecordLog_id_seq" OWNED BY public."ActiveRecordLog".id;


--
-- Name: acciones; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.acciones (
    id_accion integer NOT NULL,
    accion character varying(45) NOT NULL,
    observacion character varying(200),
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.acciones OWNER TO alvaro;

--
-- Name: acciones_id_accion_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.acciones_id_accion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.acciones_id_accion_seq OWNER TO alvaro;

--
-- Name: acciones_id_accion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.acciones_id_accion_seq OWNED BY public.acciones.id_accion;


--
-- Name: agrupaciones; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.agrupaciones (
    id_agrupacion integer NOT NULL,
    nur_padre character varying(45) NOT NULL,
    nur_hijo character varying(45) NOT NULL,
    oficial integer NOT NULL,
    fk_seguimiento_padre integer NOT NULL,
    fk_seguimiento_hijo integer NOT NULL,
    fk_usuario integer NOT NULL,
    fecha_registro date NOT NULL,
    hora_registro time(6) without time zone NOT NULL,
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.agrupaciones OWNER TO alvaro;

--
-- Name: agrupaciones_id_agrupacion_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.agrupaciones_id_agrupacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agrupaciones_id_agrupacion_seq OWNER TO alvaro;

--
-- Name: agrupaciones_id_agrupacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.agrupaciones_id_agrupacion_seq OWNED BY public.agrupaciones.id_agrupacion;


--
-- Name: alias; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.alias (
    id_alias integer NOT NULL,
    nombre character varying(500) NOT NULL,
    cargo character varying(300) NOT NULL,
    descripcion character varying(500),
    fk_usuario integer NOT NULL,
    activo integer DEFAULT 1,
    fecha_registro date,
    hora_registro time(6) without time zone
);


ALTER TABLE public.alias OWNER TO alvaro;

--
-- Name: alias_id_alias_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.alias_id_alias_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.alias_id_alias_seq OWNER TO alvaro;

--
-- Name: alias_id_alias_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.alias_id_alias_seq OWNED BY public.alias.id_alias;


--
-- Name: archivados_digitales; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.archivados_digitales (
    id_archivado_digital integer NOT NULL,
    codigo character varying(45) NOT NULL,
    fecha_archivo date NOT NULL,
    hora_archivo time without time zone NOT NULL,
    lugar character varying(100) NOT NULL,
    observaciones character varying(500) NOT NULL,
    fk_usuario integer NOT NULL,
    fk_seguimiento integer NOT NULL,
    fecha_registro date NOT NULL,
    hora_registro time without time zone NOT NULL,
    gestion integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL,
    fk_regional integer DEFAULT 0
);


ALTER TABLE public.archivados_digitales OWNER TO alvaro;

--
-- Name: archivados_digitales_id_archivado_digital_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.archivados_digitales_id_archivado_digital_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.archivados_digitales_id_archivado_digital_seq OWNER TO alvaro;

--
-- Name: archivados_digitales_id_archivado_digital_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.archivados_digitales_id_archivado_digital_seq OWNED BY public.archivados_digitales.id_archivado_digital;


--
-- Name: areas; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.areas (
    id_area integer NOT NULL,
    area character varying(200) NOT NULL,
    sigla character varying(45) NOT NULL,
    cite character varying(100) NOT NULL,
    descripcion character varying(500),
    dependencia integer DEFAULT 0,
    fk_regional integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL,
    carta integer DEFAULT 0,
    circular integer DEFAULT 0,
    informe integer DEFAULT 0,
    instructivo integer DEFAULT 0,
    memorandum integer DEFAULT 0,
    nota integer DEFAULT 0
);


ALTER TABLE public.areas OWNER TO alvaro;

--
-- Name: areas_id_area_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.areas_id_area_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.areas_id_area_seq OWNER TO alvaro;

--
-- Name: areas_id_area_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.areas_id_area_seq OWNED BY public.areas.id_area;


--
-- Name: comisiones; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public.comisiones (
    id_comision integer NOT NULL,
    comision character varying(1000) NOT NULL,
    descripcion text NOT NULL,
    areas_participantes character varying(500),
    fk_area_responsable integer,
    referencia_cite character varying(500),
    fk_documento integer DEFAULT 0,
    cite character varying(500) DEFAULT NULL::character varying,
    nuri character varying(500) DEFAULT NULL::character varying,
    fecha_registro date,
    hora_registro time without time zone,
    activo integer DEFAULT 1
);


ALTER TABLE public.comisiones OWNER TO geonode;

--
-- Name: comisiones_id_comision_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.comisiones_id_comision_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comisiones_id_comision_seq OWNER TO geonode;

--
-- Name: comisiones_id_comision_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public.comisiones_id_comision_seq OWNED BY public.comisiones.id_comision;


--
-- Name: comisiones_usuarios; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public.comisiones_usuarios (
    id_comision_usuario integer NOT NULL,
    fk_usuario integer,
    fk_comision integer,
    fk_documento integer DEFAULT 0,
    activo integer DEFAULT 1
);


ALTER TABLE public.comisiones_usuarios OWNER TO geonode;

--
-- Name: comisiones_usuarios_id_comision_usuario_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.comisiones_usuarios_id_comision_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comisiones_usuarios_id_comision_usuario_seq OWNER TO geonode;

--
-- Name: comisiones_usuarios_id_comision_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public.comisiones_usuarios_id_comision_usuario_seq OWNED BY public.comisiones_usuarios.id_comision_usuario;


--
-- Name: correlativos; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.correlativos (
    id_correlativo integer NOT NULL,
    correlativo integer DEFAULT 0 NOT NULL,
    gestion integer NOT NULL,
    fk_correlativo integer DEFAULT 0,
    fk_area integer NOT NULL,
    fk_regional integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL,
    fk_tipo_documento integer NOT NULL
);


ALTER TABLE public.correlativos OWNER TO alvaro;

--
-- Name: correlativos_id_correlativo_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.correlativos_id_correlativo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.correlativos_id_correlativo_seq OWNER TO alvaro;

--
-- Name: correlativos_id_correlativo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.correlativos_id_correlativo_seq OWNED BY public.correlativos.id_correlativo;


--
-- Name: corte; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.corte (
    id_corte integer NOT NULL,
    nro_corte integer NOT NULL,
    fecha_corte date NOT NULL,
    descripcion character varying(500),
    fecha_registro date NOT NULL,
    hora_registro time without time zone NOT NULL,
    fk_usuario integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.corte OWNER TO alvaro;

--
-- Name: corte_id_corte_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.corte_id_corte_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.corte_id_corte_seq OWNER TO alvaro;

--
-- Name: corte_id_corte_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.corte_id_corte_seq OWNED BY public.corte.id_corte;


--
-- Name: detalle_corte; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.detalle_corte (
    id_corte integer NOT NULL,
    codigo character varying(45) NOT NULL,
    derivado_por integer NOT NULL,
    derivado_a integer NOT NULL,
    proveido text NOT NULL,
    fecha_derivacion date NOT NULL,
    hora_derivacion time without time zone NOT NULL,
    fecha_recepcion date NOT NULL,
    hora_recepcion time without time zone NOT NULL,
    fk_accion integer NOT NULL,
    fk_estado integer NOT NULL,
    padre integer NOT NULL,
    oficial integer NOT NULL,
    hijo character varying(45) DEFAULT '0'::character varying,
    fecha_registro date NOT NULL,
    hora_registro time without time zone NOT NULL,
    gestion integer NOT NULL,
    confirmado integer DEFAULT 0 NOT NULL,
    fk_corte integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.detalle_corte OWNER TO alvaro;

--
-- Name: detalle_corte_id_corte_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.detalle_corte_id_corte_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.detalle_corte_id_corte_seq OWNER TO alvaro;

--
-- Name: detalle_corte_id_corte_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.detalle_corte_id_corte_seq OWNED BY public.detalle_corte.id_corte;


--
-- Name: detalle_grupo_derivacion; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public.detalle_grupo_derivacion (
    id_detalle_grupo_derivacion integer NOT NULL,
    fk_grupo_derivacion integer NOT NULL,
    usuario_origen integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.detalle_grupo_derivacion OWNER TO geonode;

--
-- Name: detalle_grupo_derivacion_id_detalle_grupo_derivacion_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.detalle_grupo_derivacion_id_detalle_grupo_derivacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.detalle_grupo_derivacion_id_detalle_grupo_derivacion_seq OWNER TO geonode;

--
-- Name: detalle_grupo_derivacion_id_detalle_grupo_derivacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public.detalle_grupo_derivacion_id_detalle_grupo_derivacion_seq OWNED BY public.detalle_grupo_derivacion.id_detalle_grupo_derivacion;


--
-- Name: documentos; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.documentos (
    id_documento integer NOT NULL,
    codigo character varying(500) NOT NULL,
    destinatario_titulo character varying(2000),
    destinatario_nombres character varying(2000),
    destinatario_cargo character varying(500),
    destinatario_institucion character varying(500),
    remitente_nombres character varying(500),
    remitente_cargo character varying(500),
    remitente_institucion character varying(500),
    referencia text NOT NULL,
    contenido text NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL,
    adjuntos character varying(500),
    copias character varying(300),
    via_nombres character varying(500),
    via_cargo character varying(500),
    nro_hojas character varying(500) DEFAULT 0,
    gestion integer NOT NULL,
    fecha_registro date NOT NULL,
    hora_registro time without time zone NOT NULL,
    fk_usuario integer NOT NULL,
    fk_tipo_documento integer NOT NULL,
    fk_estado_documento integer NOT NULL,
    fk_area integer NOT NULL,
    fk_documento integer DEFAULT 0 NOT NULL,
    ruta_documento character varying(600) DEFAULT NULL::character varying,
    activo integer DEFAULT 1 NOT NULL,
    usuario_destino integer DEFAULT 0,
    grupo_destino integer DEFAULT 0,
    nombre_grupo character varying(255),
    fk_motivo integer DEFAULT 0,
    observado integer DEFAULT 0
);


ALTER TABLE public.documentos OWNER TO alvaro;

--
-- Name: documentos_id_documento_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.documentos_id_documento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.documentos_id_documento_seq OWNER TO alvaro;

--
-- Name: documentos_id_documento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.documentos_id_documento_seq OWNED BY public.documentos.id_documento;


--
-- Name: estado_documento; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.estado_documento (
    id_estado_documento integer NOT NULL,
    estado_documento character varying(45) NOT NULL,
    descripcion character varying(500),
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.estado_documento OWNER TO alvaro;

--
-- Name: estado_documento_id_estado_documento_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.estado_documento_id_estado_documento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estado_documento_id_estado_documento_seq OWNER TO alvaro;

--
-- Name: estado_documento_id_estado_documento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.estado_documento_id_estado_documento_seq OWNED BY public.estado_documento.id_estado_documento;


--
-- Name: estados; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.estados (
    id_estado integer NOT NULL,
    estado character varying(200) NOT NULL,
    descripcion character varying(500),
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.estados OWNER TO alvaro;

--
-- Name: estados_id_estado_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.estados_id_estado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estados_id_estado_seq OWNER TO alvaro;

--
-- Name: estados_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.estados_id_estado_seq OWNED BY public.estados.id_estado;


--
-- Name: grupo_derivacion; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public.grupo_derivacion (
    id_grupo_derivacion integer NOT NULL,
    nombre_grupo character varying(200) NOT NULL,
    fk_area integer NOT NULL,
    fk_usuario integer NOT NULL,
    fk_regional integer NOT NULL,
    fecha_registro date NOT NULL,
    hora_registro time without time zone NOT NULL,
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.grupo_derivacion OWNER TO geonode;

--
-- Name: grupo_derivacion_id_grupo_derivacion_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.grupo_derivacion_id_grupo_derivacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_derivacion_id_grupo_derivacion_seq OWNER TO geonode;

--
-- Name: grupo_derivacion_id_grupo_derivacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public.grupo_derivacion_id_grupo_derivacion_seq OWNED BY public.grupo_derivacion.id_grupo_derivacion;


--
-- Name: hojas_ruta; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public.hojas_ruta (
    id_hoja_ruta integer NOT NULL,
    nur character varying(100) NOT NULL,
    codigo character varying(500) NOT NULL,
    nro integer NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL,
    proceso integer NOT NULL,
    fecha_registro date NOT NULL,
    hora_registro time without time zone NOT NULL,
    fk_usuario integer NOT NULL,
    gestion integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL,
    fk_documento integer DEFAULT 0,
    oficial integer DEFAULT 0
);


ALTER TABLE public.hojas_ruta OWNER TO geonode;

--
-- Name: COLUMN hojas_ruta.proceso; Type: COMMENT; Schema: public; Owner: geonode
--

COMMENT ON COLUMN public.hojas_ruta.proceso IS 'se cambiara a 3 en caso de nuris desvinculados y se mantendra  con activo=1 y nro=0';


--
-- Name: hojas_ruta_id_hoja_ruta_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.hojas_ruta_id_hoja_ruta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.hojas_ruta_id_hoja_ruta_seq OWNER TO geonode;

--
-- Name: hojas_ruta_id_hoja_ruta_seq1; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.hojas_ruta_id_hoja_ruta_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.hojas_ruta_id_hoja_ruta_seq1 OWNER TO geonode;

--
-- Name: hojas_ruta_id_hoja_ruta_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public.hojas_ruta_id_hoja_ruta_seq1 OWNED BY public.hojas_ruta.id_hoja_ruta;


--
-- Name: institucion_remitente; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public.institucion_remitente (
    id_institucion_remitente integer NOT NULL,
    institucion_remitente character varying(1000) NOT NULL,
    descripcion text,
    activo integer DEFAULT 1,
    nombre_remitente character varying(1000),
    cargo_remitente character varying(1000)
);


ALTER TABLE public.institucion_remitente OWNER TO geonode;

--
-- Name: institucion_remitente_id_institucion_remitente_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.institucion_remitente_id_institucion_remitente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.institucion_remitente_id_institucion_remitente_seq OWNER TO geonode;

--
-- Name: institucion_remitente_id_institucion_remitente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public.institucion_remitente_id_institucion_remitente_seq OWNED BY public.institucion_remitente.id_institucion_remitente;


--
-- Name: lista_derivacion; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.lista_derivacion (
    id_lista_derivacion integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL,
    usuario_origen integer NOT NULL,
    usuario_destino integer NOT NULL
);


ALTER TABLE public.lista_derivacion OWNER TO alvaro;

--
-- Name: lista_derivacion_id_lista_derivacion_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.lista_derivacion_id_lista_derivacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lista_derivacion_id_lista_derivacion_seq OWNER TO alvaro;

--
-- Name: lista_derivacion_id_lista_derivacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.lista_derivacion_id_lista_derivacion_seq OWNED BY public.lista_derivacion.id_lista_derivacion;


--
-- Name: motivos; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public.motivos (
    id_motivo integer NOT NULL,
    motivo character varying(1000) NOT NULL,
    descripcion text,
    activo integer DEFAULT 1
);


ALTER TABLE public.motivos OWNER TO geonode;

--
-- Name: motivos_id_motivo_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.motivos_id_motivo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.motivos_id_motivo_seq OWNER TO geonode;

--
-- Name: motivos_id_motivo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public.motivos_id_motivo_seq OWNED BY public.motivos.id_motivo;


--
-- Name: niveles; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.niveles (
    id_nivel integer NOT NULL,
    nivel character varying(100) NOT NULL,
    descripcion character varying(500),
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.niveles OWNER TO alvaro;

--
-- Name: niveles_id_nivel_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.niveles_id_nivel_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.niveles_id_nivel_seq OWNER TO alvaro;

--
-- Name: niveles_id_nivel_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.niveles_id_nivel_seq OWNED BY public.niveles.id_nivel;


--
-- Name: nombre_cargo_remitente; Type: TABLE; Schema: public; Owner: geonode
--

CREATE TABLE public.nombre_cargo_remitente (
    id_nombre_cargo_remitente integer NOT NULL,
    nombre_remitente character varying(1000) NOT NULL,
    cargo_remitente character varying(1000) NOT NULL,
    descripcion text,
    activo integer DEFAULT 1
);


ALTER TABLE public.nombre_cargo_remitente OWNER TO geonode;

--
-- Name: nombre_cargo_remitente_id_nombre_cargo_remitente_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.nombre_cargo_remitente_id_nombre_cargo_remitente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nombre_cargo_remitente_id_nombre_cargo_remitente_seq OWNER TO geonode;

--
-- Name: nombre_cargo_remitente_id_nombre_cargo_remitente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: geonode
--

ALTER SEQUENCE public.nombre_cargo_remitente_id_nombre_cargo_remitente_seq OWNED BY public.nombre_cargo_remitente.id_nombre_cargo_remitente;


--
-- Name: perfiles; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.perfiles (
    id_perfil integer NOT NULL,
    perfil character varying(100) NOT NULL,
    descripcion character varying(500),
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.perfiles OWNER TO alvaro;

--
-- Name: perfiles_id_perfil_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.perfiles_id_perfil_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.perfiles_id_perfil_seq OWNER TO alvaro;

--
-- Name: perfiles_id_perfil_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.perfiles_id_perfil_seq OWNED BY public.perfiles.id_perfil;


--
-- Name: regionales; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.regionales (
    id_regional integer NOT NULL,
    regional character varying(200) NOT NULL,
    sigla character varying(45) NOT NULL,
    descripcion character varying(500),
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.regionales OWNER TO alvaro;

--
-- Name: regionales_id_regional_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.regionales_id_regional_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.regionales_id_regional_seq OWNER TO alvaro;

--
-- Name: regionales_id_regional_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.regionales_id_regional_seq OWNED BY public.regionales.id_regional;


--
-- Name: seguimientos; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.seguimientos (
    id_seguimiento integer NOT NULL,
    codigo character varying(45) NOT NULL,
    derivado_por integer NOT NULL,
    derivado_a integer NOT NULL,
    proveido text NOT NULL,
    fecha_derivacion date NOT NULL,
    hora_derivacion time without time zone NOT NULL,
    fecha_recepcion date NOT NULL,
    hora_recepcion time without time zone NOT NULL,
    fk_accion integer NOT NULL,
    fk_estado integer NOT NULL,
    padre integer NOT NULL,
    oficial integer NOT NULL,
    hijo character varying(45) DEFAULT '0'::character varying,
    fecha_registro date NOT NULL,
    hora_registro time without time zone NOT NULL,
    gestion integer NOT NULL,
    confirmado integer DEFAULT 0 NOT NULL,
    activo integer DEFAULT 1 NOT NULL,
    fk_grupo_derivacion integer DEFAULT 0,
    fk_principal_agrupacion integer DEFAULT 0,
    numero_copia character varying(32) DEFAULT 0,
    observado integer DEFAULT 0,
    accion_archivo text,
    correlativo_copia integer DEFAULT 0
);


ALTER TABLE public.seguimientos OWNER TO alvaro;

--
-- Name: seguimientos_id_seguimiento_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.seguimientos_id_seguimiento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seguimientos_id_seguimiento_seq OWNER TO alvaro;

--
-- Name: seguimientos_id_seguimiento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.seguimientos_id_seguimiento_seq OWNED BY public.seguimientos.id_seguimiento;


--
-- Name: tipo_documento; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.tipo_documento (
    id_tipo_documento integer NOT NULL,
    tipo_documento character varying(100) NOT NULL,
    sigla character varying(45) NOT NULL,
    descripcion character varying(500),
    activo integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.tipo_documento OWNER TO alvaro;

--
-- Name: tipo_documento_id_tipo_documento_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.tipo_documento_id_tipo_documento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_documento_id_tipo_documento_seq OWNER TO alvaro;

--
-- Name: tipo_documento_id_tipo_documento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.tipo_documento_id_tipo_documento_seq OWNED BY public.tipo_documento.id_tipo_documento;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    nombre character varying(500) NOT NULL,
    cargo character varying(500) NOT NULL,
    usuario character varying(100) NOT NULL,
    password character varying(512) NOT NULL,
    correo character varying(45) NOT NULL,
    mosca character varying(45) NOT NULL,
    fk_perfil integer NOT NULL,
    fk_regional integer NOT NULL,
    fk_area integer NOT NULL,
    fk_nivel integer NOT NULL,
    fecha_registro date NOT NULL,
    hora_registro time without time zone NOT NULL,
    update_password timestamp without time zone,
    activo integer DEFAULT 1 NOT NULL,
    area_sad integer DEFAULT 0
);


ALTER TABLE public.usuarios OWNER TO alvaro;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: alvaro
--

CREATE SEQUENCE public.usuarios_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_usuario_seq OWNER TO alvaro;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alvaro
--

ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;


--
-- Name: ventanilla_id_ventanilla_seq; Type: SEQUENCE; Schema: public; Owner: geonode
--

CREATE SEQUENCE public.ventanilla_id_ventanilla_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ventanilla_id_ventanilla_seq OWNER TO geonode;

--
-- Name: ventanilla; Type: TABLE; Schema: public; Owner: alvaro
--

CREATE TABLE public.ventanilla (
    id_ventanilla integer DEFAULT nextval('public.ventanilla_id_ventanilla_seq'::regclass) NOT NULL,
    correlativo integer NOT NULL,
    gestion integer NOT NULL,
    fk_usuario integer NOT NULL,
    activo integer DEFAULT 1 NOT NULL,
    fk_regional integer NOT NULL,
    sigla character varying(50)
);


ALTER TABLE public.ventanilla OWNER TO alvaro;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public."ActiveRecordLog" ALTER COLUMN id SET DEFAULT nextval('public."ActiveRecordLog_id_seq"'::regclass);


--
-- Name: id_accion; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.acciones ALTER COLUMN id_accion SET DEFAULT nextval('public.acciones_id_accion_seq'::regclass);


--
-- Name: id_agrupacion; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.agrupaciones ALTER COLUMN id_agrupacion SET DEFAULT nextval('public.agrupaciones_id_agrupacion_seq'::regclass);


--
-- Name: id_alias; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.alias ALTER COLUMN id_alias SET DEFAULT nextval('public.alias_id_alias_seq'::regclass);


--
-- Name: id_archivado_digital; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.archivados_digitales ALTER COLUMN id_archivado_digital SET DEFAULT nextval('public.archivados_digitales_id_archivado_digital_seq'::regclass);


--
-- Name: id_area; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.areas ALTER COLUMN id_area SET DEFAULT nextval('public.areas_id_area_seq'::regclass);


--
-- Name: id_comision; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.comisiones ALTER COLUMN id_comision SET DEFAULT nextval('public.comisiones_id_comision_seq'::regclass);


--
-- Name: id_comision_usuario; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.comisiones_usuarios ALTER COLUMN id_comision_usuario SET DEFAULT nextval('public.comisiones_usuarios_id_comision_usuario_seq'::regclass);


--
-- Name: id_correlativo; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.correlativos ALTER COLUMN id_correlativo SET DEFAULT nextval('public.correlativos_id_correlativo_seq'::regclass);


--
-- Name: id_corte; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.corte ALTER COLUMN id_corte SET DEFAULT nextval('public.corte_id_corte_seq'::regclass);


--
-- Name: id_corte; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.detalle_corte ALTER COLUMN id_corte SET DEFAULT nextval('public.detalle_corte_id_corte_seq'::regclass);


--
-- Name: id_detalle_grupo_derivacion; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.detalle_grupo_derivacion ALTER COLUMN id_detalle_grupo_derivacion SET DEFAULT nextval('public.detalle_grupo_derivacion_id_detalle_grupo_derivacion_seq'::regclass);


--
-- Name: id_documento; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.documentos ALTER COLUMN id_documento SET DEFAULT nextval('public.documentos_id_documento_seq'::regclass);


--
-- Name: id_estado_documento; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.estado_documento ALTER COLUMN id_estado_documento SET DEFAULT nextval('public.estado_documento_id_estado_documento_seq'::regclass);


--
-- Name: id_estado; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.estados ALTER COLUMN id_estado SET DEFAULT nextval('public.estados_id_estado_seq'::regclass);


--
-- Name: id_grupo_derivacion; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.grupo_derivacion ALTER COLUMN id_grupo_derivacion SET DEFAULT nextval('public.grupo_derivacion_id_grupo_derivacion_seq'::regclass);


--
-- Name: id_hoja_ruta; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.hojas_ruta ALTER COLUMN id_hoja_ruta SET DEFAULT nextval('public.hojas_ruta_id_hoja_ruta_seq1'::regclass);


--
-- Name: id_institucion_remitente; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.institucion_remitente ALTER COLUMN id_institucion_remitente SET DEFAULT nextval('public.institucion_remitente_id_institucion_remitente_seq'::regclass);


--
-- Name: id_lista_derivacion; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.lista_derivacion ALTER COLUMN id_lista_derivacion SET DEFAULT nextval('public.lista_derivacion_id_lista_derivacion_seq'::regclass);


--
-- Name: id_motivo; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.motivos ALTER COLUMN id_motivo SET DEFAULT nextval('public.motivos_id_motivo_seq'::regclass);


--
-- Name: id_nivel; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.niveles ALTER COLUMN id_nivel SET DEFAULT nextval('public.niveles_id_nivel_seq'::regclass);


--
-- Name: id_nombre_cargo_remitente; Type: DEFAULT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.nombre_cargo_remitente ALTER COLUMN id_nombre_cargo_remitente SET DEFAULT nextval('public.nombre_cargo_remitente_id_nombre_cargo_remitente_seq'::regclass);


--
-- Name: id_perfil; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.perfiles ALTER COLUMN id_perfil SET DEFAULT nextval('public.perfiles_id_perfil_seq'::regclass);


--
-- Name: id_regional; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.regionales ALTER COLUMN id_regional SET DEFAULT nextval('public.regionales_id_regional_seq'::regclass);


--
-- Name: id_seguimiento; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.seguimientos ALTER COLUMN id_seguimiento SET DEFAULT nextval('public.seguimientos_id_seguimiento_seq'::regclass);


--
-- Name: id_tipo_documento; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.tipo_documento ALTER COLUMN id_tipo_documento SET DEFAULT nextval('public.tipo_documento_id_tipo_documento_seq'::regclass);


--
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);


--
-- Data for Name: ActiveRecordLog; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public."ActiveRecordLog" (id, description, action, model, idmodel, field, creationdate, userid, old_value, new_value) FROM stdin;
\.


--
-- Name: ActiveRecordLog_id_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public."ActiveRecordLog_id_seq"', 1622246, true);


--
-- Data for Name: acciones; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.acciones (id_accion, accion, observacion, activo) FROM stdin;
1	ACCION NECESARIA	SIN OBSERVACIONES	1
2	URGENTE		1
\.


--
-- Name: acciones_id_accion_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.acciones_id_accion_seq', 2, true);


--
-- Data for Name: agrupaciones; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.agrupaciones (id_agrupacion, nur_padre, nur_hijo, oficial, fk_seguimiento_padre, fk_seguimiento_hijo, fk_usuario, fecha_registro, hora_registro, activo) FROM stdin;
\.


--
-- Name: agrupaciones_id_agrupacion_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.agrupaciones_id_agrupacion_seq', 6039, true);


--
-- Data for Name: alias; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.alias (id_alias, nombre, cargo, descripcion, fk_usuario, activo, fecha_registro, hora_registro) FROM stdin;
\.


--
-- Name: alias_id_alias_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.alias_id_alias_seq', 117, true);


--
-- Data for Name: archivados_digitales; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.archivados_digitales (id_archivado_digital, codigo, fecha_archivo, hora_archivo, lugar, observaciones, fk_usuario, fk_seguimiento, fecha_registro, hora_registro, gestion, activo, fk_regional) FROM stdin;
\.


--
-- Name: archivados_digitales_id_archivado_digital_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.archivados_digitales_id_archivado_digital_seq', 3257, true);


--
-- Data for Name: areas; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.areas (id_area, area, sigla, cite, descripcion, dependencia, fk_regional, activo, carta, circular, informe, instructivo, memorandum, nota) FROM stdin;
\.


--
-- Name: areas_id_area_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.areas_id_area_seq', 98, true);


--
-- Data for Name: comisiones; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public.comisiones (id_comision, comision, descripcion, areas_participantes, fk_area_responsable, referencia_cite, fk_documento, cite, nuri, fecha_registro, hora_registro, activo) FROM stdin;
\.


--
-- Name: comisiones_id_comision_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.comisiones_id_comision_seq', 1, false);


--
-- Data for Name: comisiones_usuarios; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public.comisiones_usuarios (id_comision_usuario, fk_usuario, fk_comision, fk_documento, activo) FROM stdin;
\.


--
-- Name: comisiones_usuarios_id_comision_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.comisiones_usuarios_id_comision_usuario_seq', 1, false);


--
-- Data for Name: correlativos; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.correlativos (id_correlativo, correlativo, gestion, fk_correlativo, fk_area, fk_regional, activo, fk_tipo_documento) FROM stdin;
\.


--
-- Name: correlativos_id_correlativo_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.correlativos_id_correlativo_seq', 568, true);


--
-- Data for Name: corte; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.corte (id_corte, nro_corte, fecha_corte, descripcion, fecha_registro, hora_registro, fk_usuario, activo) FROM stdin;
\.


--
-- Name: corte_id_corte_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.corte_id_corte_seq', 1, false);


--
-- Data for Name: detalle_corte; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.detalle_corte (id_corte, codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, hijo, fecha_registro, hora_registro, gestion, confirmado, fk_corte, activo) FROM stdin;
\.


--
-- Name: detalle_corte_id_corte_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.detalle_corte_id_corte_seq', 1, false);


--
-- Data for Name: detalle_grupo_derivacion; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public.detalle_grupo_derivacion (id_detalle_grupo_derivacion, fk_grupo_derivacion, usuario_origen, activo) FROM stdin;
\.


--
-- Name: detalle_grupo_derivacion_id_detalle_grupo_derivacion_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.detalle_grupo_derivacion_id_detalle_grupo_derivacion_seq', 198, true);


--
-- Data for Name: documentos; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.documentos (id_documento, codigo, destinatario_titulo, destinatario_nombres, destinatario_cargo, destinatario_institucion, remitente_nombres, remitente_cargo, remitente_institucion, referencia, contenido, fecha, hora, adjuntos, copias, via_nombres, via_cargo, nro_hojas, gestion, fecha_registro, hora_registro, fk_usuario, fk_tipo_documento, fk_estado_documento, fk_area, fk_documento, ruta_documento, activo, usuario_destino, grupo_destino, nombre_grupo, fk_motivo, observado) FROM stdin;
\.


--
-- Name: documentos_id_documento_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.documentos_id_documento_seq', 100920, true);


--
-- Data for Name: estado_documento; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.estado_documento (id_estado_documento, estado_documento, descripcion, activo) FROM stdin;
2	DISPONIBLE	SIN DESCRIPCION	1
1	RESERVADO	SIN DESCRIPCION	1
3	ANULADO	DOCUMENTOS SIN UTILIZAR	1
5	PENDIENTE	CITES DESVINCULADOS DEL NURIS, PARA MEJOR CONTROL DEL USUARIO Y DEL SISTEMA	1
6	CONFIDENCIAL	DOCUMENTO QUE NO PODRAN SER VISTOS POR USUARIOS SIN AUTORIZACION	1
7	BORRADOR	DRAFT	1
\.


--
-- Name: estado_documento_id_estado_documento_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.estado_documento_id_estado_documento_seq', 7, true);


--
-- Data for Name: estados; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.estados (id_estado, estado, descripcion, activo) FROM stdin;
6	ARCHIVO DIGITAL	DOCUMENTOS ARCHIVADOS EN EL SISTEMA	1
5	ARCHIVO SAD	DOCUMENTOS ARCHIVADOS EN EL SISTEMA DE ARCHIVO SAD	1
1	RECIBIDO/ACCION PENDIENTE	DOCUMENTOS RECIBIDOS POR SISTEMA, SON PENDIENTES OFICIALES	1
4	RECIBIDO/DERIVADO	DOCUMENTOS RECIBIDOS Y DERIVADOS	1
2	PENDIENTE DIGITAL	COPIAS DIGITALES RECEPCIONADAS POR SISTEMA	1
3	NO RECIBIDO	DOCUMENTOS SIN RECEPCIÓN, ESTABLECER CANTIDAD DE DÍAS  PARA BLOQUEO EN EL SISTEMA	1
7	NURI AGRUPADO		1
\.


--
-- Name: estados_id_estado_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.estados_id_estado_seq', 7, true);


--
-- Data for Name: grupo_derivacion; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public.grupo_derivacion (id_grupo_derivacion, nombre_grupo, fk_area, fk_usuario, fk_regional, fecha_registro, hora_registro, activo) FROM stdin;
\.


--
-- Name: grupo_derivacion_id_grupo_derivacion_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.grupo_derivacion_id_grupo_derivacion_seq', 90, true);


--
-- Data for Name: hojas_ruta; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public.hojas_ruta (id_hoja_ruta, nur, codigo, nro, fecha, hora, proceso, fecha_registro, hora_registro, fk_usuario, gestion, activo, fk_documento, oficial) FROM stdin;
\.


--
-- Name: hojas_ruta_id_hoja_ruta_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.hojas_ruta_id_hoja_ruta_seq', 19, true);


--
-- Name: hojas_ruta_id_hoja_ruta_seq1; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.hojas_ruta_id_hoja_ruta_seq1', 92792, true);


--
-- Data for Name: institucion_remitente; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public.institucion_remitente (id_institucion_remitente, institucion_remitente, descripcion, activo, nombre_remitente, cargo_remitente) FROM stdin;
\.


--
-- Name: institucion_remitente_id_institucion_remitente_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.institucion_remitente_id_institucion_remitente_seq', 5723, true);


--
-- Data for Name: lista_derivacion; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.lista_derivacion (id_lista_derivacion, activo, usuario_origen, usuario_destino) FROM stdin;
\.


--
-- Name: lista_derivacion_id_lista_derivacion_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.lista_derivacion_id_lista_derivacion_seq', 8852, true);


--
-- Data for Name: motivos; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public.motivos (id_motivo, motivo, descripcion, activo) FROM stdin;
16	OTROS		1
17	FACTURA		1
21	INVITACION		1
22	AGRADECIMIENTO		1
23	LEGALIZACIONES	TODO TIPO DE SOLICITUDES DE LEGALIZACION	1
24	BOLETAS Y/O POLIZAS DE GARANTIA	BOLETAS O POLIZAS DE GARANTIA BANCARIA 	1
25	REITERACION 		1
26	RESPUESTA A CARTAS		1
27	URGENTE		1
28	SOLICITUD DE AUDIENCIA		1
30	SOLICITUD DE INFORME 		1
31	SOLICITUD DE INFORME DE PIE ESCRITO	\N	1
32	SOLICITUD DE INFORME DE PIE ORAL	\N	1
33	DERECHO DE VIA	SOLICITUDES DE DERECHO DE VIA O USO DE DERECHO DE VIA	1
35	INFORME	TODO TIPO DE INFORME	1
36	CERTIFICADO DE APORTES Y/O TRABAJO 	EX FUNCIONARIOS Y ACTUALES Y SUS SOLICITUDES DE CERTIFICADO DE APORTES AL EX SNC Y ADMINISTRADORA BOLIVIANA DE CARRETERAS	1
37	CERTIFICADO DE PAGO	CERTIFICADOS E INFORMES PARA SOLICITUDES DE PAGO	1
38	PERMISO DE CIRCULACION		1
39	DERECHOS DE VIA	TODAS Y CADA UNAS DE LAS SOLICITUDES DE CRUCES DE CARRETERA Y/O USO DE DERECHO DE VIA DE LA RED VIAL FUNDAMENTAL	1
40	RECLAMO		1
41	TEMAS SOCIALES 	BLOQUEOS / LLAMADAS DE ATENCION / RECLAMOS POR ESTADOS DE CARRETERAS Y OTROS	1
42	ORDEN DE CAMBIO	ORDENES DE CAMBIO AMPLIACION PLAZO PROYECTOS, CONSULTORIAS, SERVICIOS ETC.	1
43	CONTRATO MODIFICATORIO	SOLICITUDES AMPLIACION DE PLAZO Y MONTO A PROYECTOS, EMPRESAS CONTRATISTAS ETC.	1
44	REUNION	SOLICITUD O COORDINACION DE REUNIONES	1
\.


--
-- Name: motivos_id_motivo_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.motivos_id_motivo_seq', 44, true);


--
-- Data for Name: niveles; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.niveles (id_nivel, nivel, descripcion, activo) FROM stdin;
2	USUARIO ESPECIFICO	SIN DESCRIPCION	1
3	GERENCIA REGIONAL	SIN DESCRIPCION	1
4	VENTANILLA UNICA	SIN DESCRIPCION	1
1	AREA, UNIDAD, SUBGERENCIA, GERENCIA NACIONAL	SIN DESCRIPCION	1
5	VENTANILLA DE RECEPCION	CON ESTE USUARIO SE RECEPCIONAN CARTA EXTERNAS	1
6	USUARIO MEMORANDUM	USUARIOS PARA GENERAR MEMORANDUM	1
7	USUARIO-COPIA DIGITAL	USUARIO QUE PUEDE DERIVAR COPIAS DIGITALES SIN DERIVAR EL ORIGINAL, SE HABILITA UNA OPCIóN EN LA COPIAS PARA CONFIRMAR LA DERIVACIóN	0
\.


--
-- Name: niveles_id_nivel_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.niveles_id_nivel_seq', 7, true);


--
-- Data for Name: nombre_cargo_remitente; Type: TABLE DATA; Schema: public; Owner: geonode
--

COPY public.nombre_cargo_remitente (id_nombre_cargo_remitente, nombre_remitente, cargo_remitente, descripcion, activo) FROM stdin;
\.


--
-- Name: nombre_cargo_remitente_id_nombre_cargo_remitente_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.nombre_cargo_remitente_id_nombre_cargo_remitente_seq', 1, true);


--
-- Data for Name: perfiles; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.perfiles (id_perfil, perfil, descripcion, activo) FROM stdin;
1	SUPER ADMINISTRADOR	SIN DESCRIPCION	1
2	ADMINISTRADOR	SIN DESCRIPCION	1
3	GESTION DOCUMENTAL		1
4	USUARIO NORMAL		1
5	USUARIO-COPIA DIGITAL	ESTE PERFIL PERMITE AL USUARIO DERIVAR COPPIAS DIGITALES SIN NECESIDAD DE DERIVAR EL DOCUMENTO ORIGINAL EJ. PAGOS Y RESOLUCIONES	1
\.


--
-- Name: perfiles_id_perfil_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.perfiles_id_perfil_seq', 5, true);


--
-- Data for Name: regionales; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.regionales (id_regional, regional, sigla, descripcion, activo) FROM stdin;
\.


--
-- Name: regionales_id_regional_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.regionales_id_regional_seq', 10, true);


--
-- Data for Name: seguimientos; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.seguimientos (id_seguimiento, codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, hijo, fecha_registro, hora_registro, gestion, confirmado, activo, fk_grupo_derivacion, fk_principal_agrupacion, numero_copia, observado, accion_archivo, correlativo_copia) FROM stdin;
\.


--
-- Name: seguimientos_id_seguimiento_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.seguimientos_id_seguimiento_seq', 205684, true);


--
-- Data for Name: tipo_documento; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.tipo_documento (id_tipo_documento, tipo_documento, sigla, descripcion, activo) FROM stdin;
1	INFORME	INF	SIN DESCRIPCION	1
2	NOTA INTERNA	NI	SIN DESCRIPCION	1
3	MEMORANDUM	MEM	SIN DESCRIPCION	1
4	CARTA	ABC	SIN DESCRIPCION	1
5	CIRCULAR	CIR	SIN DESCRIPCION	1
6	DOCUMENTACION INTERNA	I	Este dato sirve de referencia para controlar los correlativos internos de la institucion Ej.: (I)/2018-(00012) podremos manejar "I" y el correlativo "000123"	1
7	CARTA EXTERNA	X	CARTAS INGRESADAS FUERA DE LA INSTITUCION	1
8	INSTRUCTIVO	INS	ESTA OPCION SOLO SERA VISIBLE PARA PRESIDENCIA	1
\.


--
-- Name: tipo_documento_id_tipo_documento_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.tipo_documento_id_tipo_documento_seq', 8, true);


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.usuarios (id_usuario, nombre, cargo, usuario, password, correo, mosca, fk_perfil, fk_regional, fk_area, fk_nivel, fecha_registro, hora_registro, update_password, activo, area_sad) FROM stdin;
\.


--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: alvaro
--

SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 1893, true);


--
-- Data for Name: ventanilla; Type: TABLE DATA; Schema: public; Owner: alvaro
--

COPY public.ventanilla (id_ventanilla, correlativo, gestion, fk_usuario, activo, fk_regional, sigla) FROM stdin;
\.


--
-- Name: ventanilla_id_ventanilla_seq; Type: SEQUENCE SET; Schema: public; Owner: geonode
--

SELECT pg_catalog.setval('public.ventanilla_id_ventanilla_seq', 32, true);


--
-- Name: ActiveRecordLog_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public."ActiveRecordLog"
    ADD CONSTRAINT "ActiveRecordLog_pkey" PRIMARY KEY (id);


--
-- Name: acciones_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.acciones
    ADD CONSTRAINT acciones_pkey PRIMARY KEY (id_accion);


--
-- Name: agrupaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.agrupaciones
    ADD CONSTRAINT agrupaciones_pkey PRIMARY KEY (id_agrupacion);


--
-- Name: alias_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.alias
    ADD CONSTRAINT alias_pkey PRIMARY KEY (id_alias);


--
-- Name: archivados_digitales_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.archivados_digitales
    ADD CONSTRAINT archivados_digitales_pkey PRIMARY KEY (id_archivado_digital);


--
-- Name: areas_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.areas
    ADD CONSTRAINT areas_pkey PRIMARY KEY (id_area);


--
-- Name: comisiones_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.comisiones
    ADD CONSTRAINT comisiones_pkey PRIMARY KEY (id_comision);


--
-- Name: comisiones_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.comisiones_usuarios
    ADD CONSTRAINT comisiones_usuarios_pkey PRIMARY KEY (id_comision_usuario);


--
-- Name: correlativos_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.correlativos
    ADD CONSTRAINT correlativos_pkey PRIMARY KEY (id_correlativo);


--
-- Name: corte_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.corte
    ADD CONSTRAINT corte_pkey PRIMARY KEY (id_corte);


--
-- Name: detalle_corte_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.detalle_corte
    ADD CONSTRAINT detalle_corte_pkey PRIMARY KEY (id_corte);


--
-- Name: detalle_grupo_derivacion_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.detalle_grupo_derivacion
    ADD CONSTRAINT detalle_grupo_derivacion_pkey PRIMARY KEY (id_detalle_grupo_derivacion);


--
-- Name: documentos_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.documentos
    ADD CONSTRAINT documentos_pkey PRIMARY KEY (id_documento);


--
-- Name: estado_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.estado_documento
    ADD CONSTRAINT estado_documento_pkey PRIMARY KEY (id_estado_documento);


--
-- Name: estados_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id_estado);


--
-- Name: grupo_derivacion_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.grupo_derivacion
    ADD CONSTRAINT grupo_derivacion_pkey PRIMARY KEY (id_grupo_derivacion);


--
-- Name: hojas_ruta_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.hojas_ruta
    ADD CONSTRAINT hojas_ruta_pkey PRIMARY KEY (id_hoja_ruta);


--
-- Name: institucion_remitente_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.institucion_remitente
    ADD CONSTRAINT institucion_remitente_pkey PRIMARY KEY (id_institucion_remitente);


--
-- Name: lista_derivacion_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.lista_derivacion
    ADD CONSTRAINT lista_derivacion_pkey PRIMARY KEY (id_lista_derivacion);


--
-- Name: motivos_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.motivos
    ADD CONSTRAINT motivos_pkey PRIMARY KEY (id_motivo);


--
-- Name: niveles_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.niveles
    ADD CONSTRAINT niveles_pkey PRIMARY KEY (id_nivel);


--
-- Name: nombre_cargo_remitente_pkey; Type: CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.nombre_cargo_remitente
    ADD CONSTRAINT nombre_cargo_remitente_pkey PRIMARY KEY (id_nombre_cargo_remitente);


--
-- Name: perfiles_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.perfiles
    ADD CONSTRAINT perfiles_pkey PRIMARY KEY (id_perfil);


--
-- Name: regionales_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.regionales
    ADD CONSTRAINT regionales_pkey PRIMARY KEY (id_regional);


--
-- Name: seguimientos_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.seguimientos
    ADD CONSTRAINT seguimientos_pkey PRIMARY KEY (id_seguimiento);


--
-- Name: tipo_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.tipo_documento
    ADD CONSTRAINT tipo_documento_pkey PRIMARY KEY (id_tipo_documento);


--
-- Name: usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- Name: ventanilla_pkey; Type: CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.ventanilla
    ADD CONSTRAINT ventanilla_pkey PRIMARY KEY (id_ventanilla);


--
-- Name: agrupaciones_fk_agrupaciones_seguimientos1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX agrupaciones_fk_agrupaciones_seguimientos1_idx ON public.agrupaciones USING btree (fk_seguimiento_padre);


--
-- Name: alias_fk_alias_usuarios_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX alias_fk_alias_usuarios_idx ON public.alias USING btree (fk_usuario);


--
-- Name: archivados_digitales_fk_archivados_digitales_seguimientos1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX archivados_digitales_fk_archivados_digitales_seguimientos1_idx ON public.archivados_digitales USING btree (fk_seguimiento);


--
-- Name: archivados_digitales_fk_archivados_digitales_usuarios1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX archivados_digitales_fk_archivados_digitales_usuarios1_idx ON public.archivados_digitales USING btree (fk_usuario);


--
-- Name: areas_fk_areas_regionales1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX areas_fk_areas_regionales1_idx ON public.areas USING btree (fk_regional);


--
-- Name: correlativos_fk_correlativos_areas1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX correlativos_fk_correlativos_areas1_idx ON public.correlativos USING btree (fk_area);


--
-- Name: correlativos_fk_correlativos_regionales1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX correlativos_fk_correlativos_regionales1_idx ON public.correlativos USING btree (fk_regional);


--
-- Name: corte_fk_corte_usuarios1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX corte_fk_corte_usuarios1_idx ON public.corte USING btree (fk_usuario);


--
-- Name: detalle_corte_fk_detalle_corte_corte1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX detalle_corte_fk_detalle_corte_corte1_idx ON public.detalle_corte USING btree (fk_corte);


--
-- Name: detalle_corte_fk_seguimientos_acciones1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX detalle_corte_fk_seguimientos_acciones1_idx ON public.detalle_corte USING btree (fk_accion);


--
-- Name: detalle_corte_fk_seguimientos_estados1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX detalle_corte_fk_seguimientos_estados1_idx ON public.detalle_corte USING btree (fk_estado);


--
-- Name: detalle_corte_fk_seguimientos_usuarios1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX detalle_corte_fk_seguimientos_usuarios1_idx ON public.detalle_corte USING btree (derivado_por);


--
-- Name: detalle_corte_fk_seguimientos_usuarios2_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX detalle_corte_fk_seguimientos_usuarios2_idx ON public.detalle_corte USING btree (derivado_a);


--
-- Name: documentos_fk_documentos_areas1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX documentos_fk_documentos_areas1_idx ON public.documentos USING btree (fk_area);


--
-- Name: documentos_fk_documentos_estado_documento1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX documentos_fk_documentos_estado_documento1_idx ON public.documentos USING btree (fk_estado_documento);


--
-- Name: documentos_fk_documentos_tipo_documento1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX documentos_fk_documentos_tipo_documento1_idx ON public.documentos USING btree (fk_tipo_documento);


--
-- Name: documentos_fk_documentos_usuarios1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX documentos_fk_documentos_usuarios1_idx ON public.documentos USING btree (fk_usuario);


--
-- Name: lista_derivacion_fk_lista_derivacion_usuarios1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX lista_derivacion_fk_lista_derivacion_usuarios1_idx ON public.lista_derivacion USING btree (usuario_origen);


--
-- Name: lista_derivacion_fk_lista_derivacion_usuarios2_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX lista_derivacion_fk_lista_derivacion_usuarios2_idx ON public.lista_derivacion USING btree (usuario_destino);


--
-- Name: seguimientos_fk_seguimientos_acciones1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX seguimientos_fk_seguimientos_acciones1_idx ON public.seguimientos USING btree (fk_accion);


--
-- Name: seguimientos_fk_seguimientos_estados1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX seguimientos_fk_seguimientos_estados1_idx ON public.seguimientos USING btree (fk_estado);


--
-- Name: seguimientos_fk_seguimientos_usuarios1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX seguimientos_fk_seguimientos_usuarios1_idx ON public.seguimientos USING btree (derivado_por);


--
-- Name: seguimientos_fk_seguimientos_usuarios2_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX seguimientos_fk_seguimientos_usuarios2_idx ON public.seguimientos USING btree (derivado_a);


--
-- Name: usuarios_fk_usuarios_areas1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX usuarios_fk_usuarios_areas1_idx ON public.usuarios USING btree (fk_area);


--
-- Name: usuarios_fk_usuarios_niveles1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX usuarios_fk_usuarios_niveles1_idx ON public.usuarios USING btree (fk_nivel);


--
-- Name: usuarios_fk_usuarios_perfiles1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX usuarios_fk_usuarios_perfiles1_idx ON public.usuarios USING btree (fk_perfil);


--
-- Name: usuarios_fk_usuarios_regionales1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX usuarios_fk_usuarios_regionales1_idx ON public.usuarios USING btree (fk_regional);


--
-- Name: ventanilla_fk_ventanilla_usuarios1_idx; Type: INDEX; Schema: public; Owner: alvaro
--

CREATE INDEX ventanilla_fk_ventanilla_usuarios1_idx ON public.ventanilla USING btree (fk_usuario);


--
-- Name: fk_agrupaciones_seguimientos1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.agrupaciones
    ADD CONSTRAINT fk_agrupaciones_seguimientos1 FOREIGN KEY (fk_seguimiento_padre) REFERENCES public.seguimientos(id_seguimiento);


--
-- Name: fk_alias_usuarios; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.alias
    ADD CONSTRAINT fk_alias_usuarios FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_archivados_digitales_seguimientos1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.archivados_digitales
    ADD CONSTRAINT fk_archivados_digitales_seguimientos1 FOREIGN KEY (fk_seguimiento) REFERENCES public.seguimientos(id_seguimiento);


--
-- Name: fk_archivados_digitales_usuarios1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.archivados_digitales
    ADD CONSTRAINT fk_archivados_digitales_usuarios1 FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_areas_regionales1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.areas
    ADD CONSTRAINT fk_areas_regionales1 FOREIGN KEY (fk_regional) REFERENCES public.regionales(id_regional);


--
-- Name: fk_correlativos_areas1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.correlativos
    ADD CONSTRAINT fk_correlativos_areas1 FOREIGN KEY (fk_area) REFERENCES public.areas(id_area);


--
-- Name: fk_correlativos_regionales1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.correlativos
    ADD CONSTRAINT fk_correlativos_regionales1 FOREIGN KEY (fk_regional) REFERENCES public.regionales(id_regional);


--
-- Name: fk_corte_usuarios1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.corte
    ADD CONSTRAINT fk_corte_usuarios1 FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_detalle_corte_corte1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.detalle_corte
    ADD CONSTRAINT fk_detalle_corte_corte1 FOREIGN KEY (fk_corte) REFERENCES public.corte(id_corte);


--
-- Name: fk_documentos_areas1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.documentos
    ADD CONSTRAINT fk_documentos_areas1 FOREIGN KEY (fk_area) REFERENCES public.areas(id_area);


--
-- Name: fk_documentos_estado_documento1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.documentos
    ADD CONSTRAINT fk_documentos_estado_documento1 FOREIGN KEY (fk_estado_documento) REFERENCES public.estado_documento(id_estado_documento);


--
-- Name: fk_documentos_tipo_documento1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.documentos
    ADD CONSTRAINT fk_documentos_tipo_documento1 FOREIGN KEY (fk_tipo_documento) REFERENCES public.tipo_documento(id_tipo_documento);


--
-- Name: fk_documentos_usuarios1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.documentos
    ADD CONSTRAINT fk_documentos_usuarios1 FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_hojas_ruta_usuarios1; Type: FK CONSTRAINT; Schema: public; Owner: geonode
--

ALTER TABLE ONLY public.hojas_ruta
    ADD CONSTRAINT fk_hojas_ruta_usuarios1 FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_lista_derivacion_usuarios1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.lista_derivacion
    ADD CONSTRAINT fk_lista_derivacion_usuarios1 FOREIGN KEY (usuario_origen) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_lista_derivacion_usuarios2; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.lista_derivacion
    ADD CONSTRAINT fk_lista_derivacion_usuarios2 FOREIGN KEY (usuario_destino) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_seguimientos_acciones1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.seguimientos
    ADD CONSTRAINT fk_seguimientos_acciones1 FOREIGN KEY (fk_accion) REFERENCES public.acciones(id_accion);


--
-- Name: fk_seguimientos_acciones10; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.detalle_corte
    ADD CONSTRAINT fk_seguimientos_acciones10 FOREIGN KEY (fk_accion) REFERENCES public.acciones(id_accion);


--
-- Name: fk_seguimientos_estados1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.seguimientos
    ADD CONSTRAINT fk_seguimientos_estados1 FOREIGN KEY (fk_estado) REFERENCES public.estados(id_estado);


--
-- Name: fk_seguimientos_estados10; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.detalle_corte
    ADD CONSTRAINT fk_seguimientos_estados10 FOREIGN KEY (fk_estado) REFERENCES public.estados(id_estado);


--
-- Name: fk_seguimientos_usuarios1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.seguimientos
    ADD CONSTRAINT fk_seguimientos_usuarios1 FOREIGN KEY (derivado_por) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_seguimientos_usuarios10; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.detalle_corte
    ADD CONSTRAINT fk_seguimientos_usuarios10 FOREIGN KEY (derivado_por) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_seguimientos_usuarios2; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.seguimientos
    ADD CONSTRAINT fk_seguimientos_usuarios2 FOREIGN KEY (derivado_a) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_seguimientos_usuarios20; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.detalle_corte
    ADD CONSTRAINT fk_seguimientos_usuarios20 FOREIGN KEY (derivado_a) REFERENCES public.usuarios(id_usuario);


--
-- Name: fk_usuarios_areas1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT fk_usuarios_areas1 FOREIGN KEY (fk_area) REFERENCES public.areas(id_area);


--
-- Name: fk_usuarios_niveles1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT fk_usuarios_niveles1 FOREIGN KEY (fk_nivel) REFERENCES public.niveles(id_nivel);


--
-- Name: fk_usuarios_perfiles1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT fk_usuarios_perfiles1 FOREIGN KEY (fk_perfil) REFERENCES public.perfiles(id_perfil);


--
-- Name: fk_usuarios_regionales1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT fk_usuarios_regionales1 FOREIGN KEY (fk_regional) REFERENCES public.regionales(id_regional);


--
-- Name: fk_ventanilla_usuarios1; Type: FK CONSTRAINT; Schema: public; Owner: alvaro
--

ALTER TABLE ONLY public.ventanilla
    ADD CONSTRAINT fk_ventanilla_usuarios1 FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

