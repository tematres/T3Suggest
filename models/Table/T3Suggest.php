<?php
/**
 * Tematres Suggest
 *
 * @copyright Copyright 2025 Diego Ferreyra
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Tematres Suggest plugin.
 *
**/
/**
 * The T3_suggests table.
 *
 * @package Omeka\Plugins\T3Suggest
 */
class Table_T3Suggest extends Omeka_Db_Table
{
    /**
     * List of some suggest endpoints available in Tematres. You can add your own vocabulary or see the the know case list of Tematres vocabularies in https://vocabularyserver.com/vocabularies/
     *
     *
     * @see https://vocabularyserver.com/vocabularies/
     */
    private $_suggestEndpoints = array(

   'http://vocabularios.caicyt.gov.ar/actindustriales/suggest.php' => array(
            'name' => 'Códigos CONICET de Actividades Industriales',
            'url'  => 'http://vocabularios.caicyt.gov.ar/actindustriales/',
        ),
    'http://vocabularios.caicyt.gov.ar/afip/suggest.php' => array(
            'name' => 'Clasificación de actividades económicas (CLAE)',
            'url'  => 'http://vocabularios.caicyt.gov.ar/afip/',
        ),
    'http://vocabularios.caicyt.gov.ar/asfa/suggest.php' => array(
            'name' => 'Aquatic Sciences and Fisheries Thesaurus',
            'url'  => 'http://vocabularios.caicyt.gov.ar/asfa/',
        ),
    'http://vocabularios.caicyt.gov.ar/biblioclastia/suggest.php' => array(
            'name' => 'Vocabulario controlado sobre Biblioclastia',
            'url'  => 'http://vocabularios.caicyt.gov.ar/biblioclastia/',
        ),
    'http://vocabularios.caicyt.gov.ar/calish/suggest.php' => array(
            'name' => 'CaLiSH',
            'url'  => 'http://vocabularios.caicyt.gov.ar/calish/',
        ),
    'http://vocabularios.caicyt.gov.ar/campoapp/suggest.php' => array(
            'name' => 'Códigos CONICET de campo de Aplicación',
            'url'  => 'http://vocabularios.caicyt.gov.ar/campoapp/',
        ),
    'http://vocabularios.caicyt.gov.ar/cdpd/suggest.php' => array(
            'name' => 'Vocabulario inclusivo de género especializado en Discapacidad y Derechos Humanos',
            'url'  => 'http://vocabularios.caicyt.gov.ar/cdpd/',
        ),
    'https://vocabularyserver.com/udc/es/suggest.php' => array(
            'name' => 'Clasificación Decimal Universal (Sumarios)',
            'url'  => 'https://vocabularyserver.com/udc/es/',
        ),
    'http://vocabularios.caicyt.gov.ar/cerela/suggest.php' => array(
            'name' => 'Vocabulario controlado de CERELA',
            'url'  => 'http://vocabularios.caicyt.gov.ar/cerela/',
        ),
    'http://vocabularios.caicyt.gov.ar/coar/tipo/suggest.php' => array(
            'name' => 'Vocabulario de tipos de recursos de información',
            'url'  => 'http://vocabularios.caicyt.gov.ar/coar/tipo/',
        ),
    'http://vocabularios.caicyt.gov.ar/ccc/suggest.php' => array(
            'name' => 'Vocabulario del Centro Cultural de la Cooperación',
            'url'  => 'http://vocabularios.caicyt.gov.ar/ccc/',
        ),
    'http://vocabularios.caicyt.gov.ar/deportes/suggest.php' => array(
            'name' => 'Vocabulario controlado sobre deportes',
            'url'  => 'http://vocabularios.caicyt.gov.ar/deportes/',
        ),
    'http://vocabularios.caicyt.gov.ar/disciplinas/suggest.php' => array(
            'name' => 'Códigos CONICET de disciplinas',
            'url'  => 'http://vocabularios.caicyt.gov.ar/disciplinas/',
        ),
    'http://vocabularios.caicyt.gov.ar/flacso/suggest.php' => array(
            'name' => 'Vocabulario Controlado FLACSO Argentina',
            'url'  => 'http://vocabularios.caicyt.gov.ar/flacso/',
        ),
    'http://vocabularios.caicyt.gov.ar/fos/suggest.php' => array(
            'name' => 'Taxonomía de campos de la ciencia y la tecnlogía (FOS)',
            'url'  => 'http://vocabularios.caicyt.gov.ar/fos/',
        ),
    'http://vocabularios.caicyt.gov.ar/gemet/suggest.php' => array(
            'name' => 'GEMET Thesaurus',
            'url'  => 'http://vocabularios.caicyt.gov.ar/gemet/',
        ),
    'http://vocabularios.caicyt.gov.ar/glosario/suggest.php' => array(
            'name' => 'Glosario de Comunicación Científica',
            'url'  => 'http://vocabularios.caicyt.gov.ar/glosario/',
        ),
    'http://vocabularios.caicyt.gov.ar/historiaargentina/suggest.php' => array(
            'name' => 'Tesauro de Historia Argentina',
            'url'  => 'http://vocabularios.caicyt.gov.ar/historiaargentina/',
        ),
    'http://vocabularios.caicyt.gov.ar/historiaoccidente/suggest.php' => array(
            'name' => 'Historia de Occidente',
            'url'  => 'http://vocabularios.caicyt.gov.ar/historiaoccidente/',
        ),
    'http://vocabularios.caicyt.gov.ar/issn/suggest.php' => array(
            'name' => 'Agencia ISSN: Listas de valores',
            'url'  => 'http://vocabularios.caicyt.gov.ar/issn/',
        ),
    'http://vocabularios.caicyt.gov.ar/kemlu/suggest.php' => array(
            'name' => 'ATESCT: Acervo Terminológico sobre Estudios Sociales de la Ciencia y Tecnología',
            'url'  => 'http://vocabularios.caicyt.gov.ar/kemlu/',
        ),
    'http://vocabularios.caicyt.gov.ar/latindextema/suggest.php' => array(
            'name' => 'Latindex: temas',
            'url'  => 'http://vocabularios.caicyt.gov.ar/latindextema/',
        ),
    'http://vocabularios.caicyt.gov.ar/mmpeaah/suggest.php' => array(
            'name' => 'Herbario del Museo Municipal Lorenzo Scaglia',
            'url'  => 'http://vocabularios.caicyt.gov.ar/mmpeaah/',
        ),
    'http://vocabularios.caicyt.gov.ar/monarquiahispanica/suggest.php' => array(
            'name' => 'Catálogo de cargos administrativos de la Monarquía hispánica en época moderna',
            'url'  => 'http://vocabularios.caicyt.gov.ar/monarquiahispanica/',
        ),
    'http://vocabularios.caicyt.gov.ar/plosar/suggest.php' => array(
            'name' => 'Tesauro PLOS',
            'url'  => 'http://vocabularios.caicyt.gov.ar/plosar/',
        ),
    'http://vocabularios.caicyt.gov.ar/pmc/suggest.php' => array(
            'name' => 'Poesía medieval castellana',
            'url'  => 'http://vocabularios.caicyt.gov.ar/pmc/',
        ),
    'http://vocabularios.caicyt.gov.ar/ravignani/suggest.php' => array(
            'name' => 'Vocabulario de Historia Argentina y Americana',
            'url'  => 'http://vocabularios.caicyt.gov.ar/ravignani/',
        ),
    'http://vocabularios.caicyt.gov.ar/reposhistoricos/suggest.php' => array(
            'name' => 'Marco conceptual para Archivos históricos en formato digital para la investigación científica',
            'url'  => 'http://vocabularios.caicyt.gov.ar/reposhistoricos/',
        ),
    'http://vocabularios.caicyt.gov.ar/resposabilidadsocial/suggest.php' => array(
            'name' => 'Vocabulario sobre responsabilidad social en bibliotecas',
            'url'  => 'http://vocabularios.caicyt.gov.ar/resposabilidadsocial/',
        ),
    'http://vocabularios.caicyt.gov.ar/salud/suggest.php' => array(
            'name' => 'Vocabulario de Ciencias de la Salud para Argentina',
            'url'  => 'http://vocabularios.caicyt.gov.ar/salud/',
        ),
    'http://vocabularios.caicyt.gov.ar/sociables/suggest.php' => array(
            'name' => 'Vocabulario Latinoamericano de Ciencias Sociales',
            'url'  => 'http://vocabularios.caicyt.gov.ar/sociables/',
        ),
    'http://vocabularios.caicyt.gov.ar/spines/suggest.php' => array(
            'name' => 'Tesauro SPINES',
            'url'  => 'http://vocabularios.caicyt.gov.ar/spines/',
        ),
    'http://vocabularios.caicyt.gov.ar/tesinfo/suggest.php' => array(
            'name' => 'Tesauro sobre información y conocimiento',
            'url'  => 'http://vocabularios.caicyt.gov.ar/tesinfo/',
        ),
    'http://vocabularios.caicyt.gov.ar/uat/suggest.php' => array(
            'name' => 'Unified Astronomy Thesaurus',
            'url'  => 'http://vocabularios.caicyt.gov.ar/uat/',
        ),
    'http://vocabularios.caicyt.gov.ar/unesco/suggest.php' => array(
            'name' => 'Nomenclatura UNESCO de Ciencia y Tecnología',
            'url'  => 'http://vocabularios.caicyt.gov.ar/unesco/',
        ),
    'https://www.vocabularyserver.com/tadirah/es/suggest.php' => array(
            'name' => 'TaDiRAH - Taxonomía sobre Actividades de investigación digital en humanidades',
            'url'  => 'https://www.vocabularyserver.com/tadirah/es/',
        ),
    'https://www.vocabularyserver.com/vitruvio/suggest.php' => array(
            'name' => 'Vocabulario Vitruvio',
            'url'  => 'https://www.vocabularyserver.com/vitruvio/',
        ),
    'http://vocabularios.caicyt.gov.ar/geoar/vocab/suggest.php' => array(
            'name' => 'Topónimos argentina',
            'url'  => 'http://vocabularios.caicyt.gov.ar/geoar/vocab/',
        ),
    'http://vocabularios.caicyt.gov.ar/geoar/codes/suggest.php' => array(
            'name' => 'Tipos de accidentes geográficos',
            'url'  => 'http://vocabularios.caicyt.gov.ar/geoar/codes/',
        ),
    'https://vocabularyserver.com/psicologia/suggest.php' => array(
            'name' => 'Tesauro de Psicología',
            'url'  => 'https://vocabularyserver.com/psicologia/',
        ),
    'https://vocabularyserver.com/bll/es/suggest.php' => array(
            'name' => 'Tesauro de lingüística',
            'url'  => 'https://vocabularyserver.com/bll/es/',
        ),
    'https://vocabularyserver.com/physh/suggest.php' => array(
            'name' => 'Physics Subject Headings - Physh',
            'url'  => 'https://vocabularyserver.com/physh/',
        ),
    'http://vocabularios.caicyt.gov.ar/geologia/suggest.php' => array(
            'name' => 'Vocabulario de Geología',
            'url'  => 'http://vocabularios.caicyt.gov.ar/geologia/',
        ),
    'http://vocabularios.caicyt.gov.ar/etnomusica/suggest.php' => array(
            'name' => 'Vocabulario Estudios etnográficos de la música',
            'url'  => 'http://vocabularios.caicyt.gov.ar/etnomusica/',
        ),
    'http://vocabularios.caicyt.gov.ar/economiasocial/suggest.php' => array(
            'name' => 'Tesauro de economía social',
            'url'  => 'http://vocabularios.caicyt.gov.ar/economiasocial/',
        ),
    );

    /**
     * Find a suggest record by element ID.
     *
     * @param int|string $elementId
     * @return T3Suggest|null
     */
    public function findByElementId($elementId)
    {
        $select = $this->getSelect()->where('element_id = ?', $elementId);
        return $this->fetchObject($select);
    }

    /**
     * Get the suggest endpoints.
     *
     * @return array
     */
    public function getSuggestEndpoints()
    {
        return $this->_suggestEndpoints;
    }
}
