<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* base.html.twig */
class __TwigTemplate_ce72026e5ea2709bb3c15f042e3302be00f368da36a89018d3f0fd5da433a9fc extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'style' => [$this, 'block_style'],
            'sous_title' => [$this, 'block_sous_title'],
            'header_search' => [$this, 'block_header_search'],
            'navbar_left' => [$this, 'block_navbar_left'],
            'navbar_right' => [$this, 'block_navbar_right'],
            'third_header' => [$this, 'block_third_header'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>

<head>
\t<meta charset=\"UTF-8\">
\t<title>
\t\t";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        // line 10
        echo "\t\t| CRM AMDIE
\t</title>

\t<meta charset=\"utf-8\">
\t<link rel=\"icon\" type=\"image/png\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/amdie.png"), "html", null, true);
        echo "\" />
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\">
\t<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
\t<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js\"></script>
\t<link href=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css\" rel=\"stylesheet\" />
\t<script src=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js\"></script>
\t<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@10\"></script>
\t<script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/app.js"), "html", null, true);
        echo "\"></script>
\t";
        // line 24
        $context["currentRoute"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 24, $this->source); })()), "request", [], "any", false, false, false, 24), "attributes", [], "any", false, false, false, 24), "get", [0 => "_route"], "method", false, false, false, 24);
        // line 25
        echo "\t";
        if ((0 === twig_compare(twig_in_filter("event", (isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 25, $this->source); })())), false))) {
            // line 26
            echo "\t<link rel=\"stylesheet\" type=\"text/css\"
\t\thref=\"https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.22/datatables.min.css\" />

\t<script type=\"text/javascript\" src=\"https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.22/datatables.min.js\"></script>
\t";
        }
        // line 31
        echo "\t<!-- Font Awesome -->
\t<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css\">
\t<!-- Ionicons -->
\t<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css\">
\t<link href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">
\t<link href=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/custom.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">
\t<link href=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/style-responsive.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">

\t<link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap\" rel=\"stylesheet\">
\t";
        // line 40
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('style', $context, $blocks);
        // line 41
        echo "\t<script>
\t\t\$(document).ready(function () {
\t\t\t\$(\".button\").click(function () {
\t\t\t\t\$(\".body-container\").addClass(\"modal-mobile\")
\t\t\t\t\$(\".modal-mobile\").fadeIn();
\t\t\t\t\$(\"row-wrape-filter-project\").css(\"overflow\", \"hidden\");
\t\t\t});
\t\t\t\$(\".cross\").click(function () {
\t\t\t\tconsole.log(\"test\");
\t\t\t\t\$(\".modal-mobile\").fadeOut();
\t\t\t\t\$(\"row-wrape-filter-project\").css(\"overflow\", \"auto\");
\t\t\t});
\t\t});
\t</script>


</head>

<body class=\"page_";
        // line 59
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, (isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 59, $this->source); })())), "html", null, true);
        echo " ";
        echo ((twig_in_filter("event", (isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 59, $this->source); })()))) ? ("event") : (""));
        echo "\">
<div class=\"desktop\">

\t<!-- flash msg zone -->
\t";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 63, $this->source); })()), "flashes", [0 => "success"], "method", false, false, false, 63));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 64
            echo "\t<script>
\t\tSwal.fire({
\t\t\tposition: 'top-end',
\t\t\ticon: 'success',
\t\t\ttitle: '";
            // line 68
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "',
\t\t\tshowConfirmButton: false,
\t\t\ttimer: 3000
\t\t})
\t</script>

\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "
\t<!-- /flash msg zone -->
\t<div class=\"sticky\">
\t
\t<nav class=\"navbar navbar-expand-lg navbar-light bg-light menuMobile\">
\t";
        // line 80
        $this->displayBlock('sous_title', $context, $blocks);
        // line 93
        echo "\t\t<div class=\"nav_toggle\">
\t\t\t<button class=\"nav-toggle\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\"
\t\t\t\taria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
\t\t\t\t<span class=\"nav-toggle__text\">Toggle Menu</span>
\t\t\t</button>
\t\t</div>


\t\t<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">

\t\t\t<ul class=\"navbar-nav mr-auto\"></ul>
\t\t\t";
        // line 105
        echo "\t\t\t";
        // line 107
        echo "\t\t\t\t\t";
        // line 108
        echo "
\t\t\t\t\t";
        // line 118
        echo "\t\t\t";
        $this->displayBlock('header_search', $context, $blocks);
        // line 125
        echo "\t\t\t";
        $context["currentRoute"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 125, $this->source); })()), "request", [], "any", false, false, false, 125), "attributes", [], "any", false, false, false, 125), "get", [0 => "_route"], "method", false, false, false, 125);
        // line 126
        echo "\t\t\t<ul class=\"nav navbar-nav navbar-right main-menu\">

\t\t\t\t";
        // line 128
        if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 128, $this->source); })()), "user", [], "any", false, false, false, 128), "groupe", [], "any", false, false, false, 128), "id", [], "any", false, false, false, 128), 1))) {
            // line 129
            echo "\t\t\t\t<li class=\"nav-item dropdown drop-list\">
\t\t\t\t\t<a class=\"nav-link-global dropdown-toggle current-page\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
\t\t\t\t\t\tdata-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t\t\tAdministration
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"dropdown-menu header-navbar\" aria-labelledby=\"navbarDropdown\">
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 135
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 135, $this->source); })()), "user_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 136
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("user.titre_user"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 138
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 138, $this->source); })()), "role_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 139
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("role_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("role.titre_role"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 141
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 141, $this->source); })()), "restriction_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 142
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("restriction_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("restriction.Restriction"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 144
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 144, $this->source); })()), "groupe_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 145
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("groupe_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("groupe.titre_groupe"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 147
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 147, $this->source); })()), "permission_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 148
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("permission_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("acces.Acces"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 150
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 150, $this->source); })()), "secteur_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 151
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("secteur_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("secteur.Secteur"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 153
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 153, $this->source); })()), "profils_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 154
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("profils_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("profil.Profils"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 156
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 156, $this->source); })()), "canal_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 157
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("canal_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("canal.Canals"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item ";
            // line 159
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 159, $this->source); })()), "fonction_index"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 160
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("fonction_index");
            echo "\">Fonction</a>
\t\t\t\t\t</div>
\t\t\t\t</li>
\t\t\t\t";
        } else {
            // line 164
            echo "\t\t\t\t<li class=\"nav-item dropdown drop-list\">
\t\t\t\t\t<a class=\"nav-link-global dropdown-toggle current-page-user\" href=\"#\" id=\"navbarDropdown\"
\t\t\t\t\t\trole=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t\t\tGestion
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"dropdown-menu  header-navbar\" aria-labelledby=\"navbarDropdown\">
\t\t\t\t\t\t";
            // line 172
            echo "\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"";
            // line 173
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("contact.Contacts"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"";
            // line 176
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("compte_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("compte.Compte"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"";
            // line 179
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("partenaire_list");
            echo "\">Partenaires</a>
\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"";
            // line 182
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("projet.Projects"), "html", null, true);
            echo "</a>
\t\t\t\t\t\t";
            // line 185
            echo "\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"";
            // line 187
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("events_index");
            echo "\">Events</a>
\t\t\t\t\t\t";
            // line 189
            echo "\t\t\t\t\t\t";
            // line 191
            echo "
\t\t\t\t\t</div>
\t\t\t\t</li>
\t\t\t\t<li class=\"nav-item dropdown drop-list\">
\t\t\t\t\t<a class=\"nav-link-global dropdown-toggle current-page\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
\t\t\t\t\t\tdata-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t\t\tConsole
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
\t\t\t\t\t\t";
            // line 202
            echo "\t\t\t\t\t\t";
            if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 202, $this->source); })()), "user", [], "any", false, false, false, 202), "groupe", [], "any", false, false, false, 202), "nom", [], "any", false, false, false, 202), "Business Developers Export"))) {
                // line 203
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/9T4VBWVWNX?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 204
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 204, $this->source); })()), "user", [], "any", false, false, false, 204), "groupe", [], "any", false, false, false, 204), "nom", [], "any", false, false, false, 204), "Business Developers Investissement"))) {
                // line 205
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/1gFrp52eTv?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 206
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 206, $this->source); })()), "user", [], "any", false, false, false, 206), "groupe", [], "any", false, false, false, 206), "nom", [], "any", false, false, false, 206), "Departement Investissement"))) {
                // line 207
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/1gFrp52eTv?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 208
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 208, $this->source); })()), "user", [], "any", false, false, false, 208), "groupe", [], "any", false, false, false, 208), "nom", [], "any", false, false, false, 208), "Directeur - GPAC"))) {
                // line 209
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/Ewcd7VhM0G?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 210
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 210, $this->source); })()), "user", [], "any", false, false, false, 210), "groupe", [], "any", false, false, false, 210), "nom", [], "any", false, false, false, 210), "Directeur Investissement"))) {
                // line 211
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/rp-epIKFEt?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 212
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 212, $this->source); })()), "user", [], "any", false, false, false, 212), "groupe", [], "any", false, false, false, 212), "nom", [], "any", false, false, false, 212), "Directeur-transverse"))) {
                // line 213
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/-MAJ1wO-oF?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkSharee\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 214
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 214, $this->source); })()), "user", [], "any", false, false, false, 214), "groupe", [], "any", false, false, false, 214), "nom", [], "any", false, false, false, 214), "Direction Générale - DG"))) {
                // line 215
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/SbrGxLCWvj?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 216
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 216, $this->source); })()), "user", [], "any", false, false, false, 216), "groupe", [], "any", false, false, false, 216), "nom", [], "any", false, false, false, 216), "Département Export"))) {
                // line 217
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/9T4VBWVWNX?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 218
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 218, $this->source); })()), "user", [], "any", false, false, false, 218), "groupe", [], "any", false, false, false, 218), "nom", [], "any", false, false, false, 218), "Gestion Directeur Export"))) {
                // line 219
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/9T4VBWVWNX?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 220
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 220, $this->source); })()), "user", [], "any", false, false, false, 220), "groupe", [], "any", false, false, false, 220), "nom", [], "any", false, false, false, 220), "Gestionnaires CRM & KPI"))) {
                // line 221
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/pI2AzABKG6?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 222
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 222, $this->source); })()), "user", [], "any", false, false, false, 222), "groupe", [], "any", false, false, false, 222), "nom", [], "any", false, false, false, 222), "Responsable-GPAC"))) {
                // line 223
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/Ewcd7VhM0G?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 224
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 224, $this->source); })()), "user", [], "any", false, false, false, 224), "groupe", [], "any", false, false, false, 224), "nom", [], "any", false, false, false, 224), "Utilisateurs - transverses"))) {
                // line 225
                echo "\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/-MAJ1wO-oF?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t";
            }
            // line 227
            echo "\t\t\t\t\t\t<a class=\"nav-link ";
            echo (((0 === twig_compare((isset($context["currentRoute"]) || array_key_exists("currentRoute", $context) ? $context["currentRoute"] : (function () { throw new RuntimeError('Variable "currentRoute" does not exist.', 227, $this->source); })()), "projets_dashbord"))) ? ("active") : (""));
            echo "\"
\t\t\t\t\t\t\thref=\"";
            // line 228
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_dashbord");
            echo "\">Dashbord</a>
\t\t\t\t\t</div>
\t\t\t\t</li>

\t\t\t\t";
        }
        // line 233
        echo "\t\t\t\t<li class=\"nav-item dropdown drop-list\">
\t\t\t\t\t<a class=\"nav-link-global dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
\t\t\t\t\t\tdata-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t\t\t";
        // line 236
        echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 236, $this->source); })()), "user", [], "any", false, false, false, 236), "prenom", [], "any", false, false, false, 236)), "html", null, true);
        echo "
\t\t\t\t\t\t";
        // line 237
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 237, $this->source); })()), "user", [], "any", false, false, false, 237), "nom", [], "any", false, false, false, 237)), "html", null, true);
        echo "
\t\t\t\t\t\t";
        // line 239
        echo "\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
\t\t\t\t\t\t<a class=\"dropdown-item\" href=\"";
        // line 241
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_edit_profile", ["id" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 241, $this->source); })()), "user", [], "any", false, false, false, 241), "id", [], "any", false, false, false, 241)]), "html", null, true);
        echo "\">Mon Profile</a>
\t\t\t\t\t\t<a class=\"dropdown-item\" href=\"";
        // line 242
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        echo "\">Déconnexion</a>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t</li>
\t\t\t</ul>

\t\t</div>
\t</nav>

\t<nav class=\"navbar navbar-expand-lg navbar-light navbar-blue transaction\">

\t\t<div class=\"collapse navbar-collapse\">
\t\t\t<ul class=\"navbar-nav mr-auto\"> ";
        // line 254
        $this->displayBlock('navbar_left', $context, $blocks);
        // line 255
        echo "\t\t\t</ul>

\t\t\t<ul class=\"nav navbar-nav navbar-right\"> ";
        // line 257
        $this->displayBlock('navbar_right', $context, $blocks);
        // line 258
        echo "\t\t\t</ul>

\t\t</div>
\t</nav>
\t</div>
\t<div class=\"contentst\">
\t";
        // line 264
        $this->displayBlock('third_header', $context, $blocks);
        // line 265
        echo "\t</div>
\t<div class=\"container-dash\" width=\" 100%\"> ";
        // line 266
        $this->displayBlock('body', $context, $blocks);
        // line 267
        echo "\t</div>
\t";
        // line 268
        $this->displayBlock('javascripts', $context, $blocks);
        // line 269
        echo "\t<script src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/dom.js"), "html", null, true);
        echo "\"></script>
\t<div class=\"clear\"></div>
\t<link href=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css\" rel=\"stylesheet\" />
\t<script src=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js\"></script>
\t<script src=\"https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js\"></script>
\t<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css\" />
\t<script src=\"";
        // line 277
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/custom.js"), "html", null, true);
        echo "\"></script>
\t<script>
\t\t\$(document).ready(function () {
\t\t\tbsCustomFileInput.init()
\t\t})
\t</script>
</div>
<div class=\"mobile\">
<div class=\"row\">
\t\t\t<div class=\"col-lg-12 col-md-6\">
\t\t\t\t<div class=\"descLogin\">
\t\t\t\t\t<div>
\t\t\t\t\t\t<img src=\"/images/illustration.png\" alt=\"\" style=\"position: relative;width: 100%;\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"\">
\t\t\t\t\t\t  <img src=\"/images/logoAmdie.png\" alt=\"\"  style=\"display: block;margin-left: auto;margin-right: auto;width: 50%\";>
\t\t\t\t\t  </div>
\t\t\t\t\t<div class=\"textLogin\">
\t\t\t\t\t\t<div class=\"titre-textLogin\">
\t\t\t\t\t\t\t<h1> Doing business with Morocco </h1>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"desc-textLogin\" style=\"text-align: justify;\">
\t\t\t\t\t\t\t<p> Cette solution CRM vise à suivre le funnel commercial des clients à prospecter par l'AMDIE </p>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
</div>\t
</div>
</body>

</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 7
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "\t\tIndex
\t\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 40
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function block_style($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "style"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "style"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 80
    public function block_sous_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sous_title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sous_title"));

        // line 81
        echo "\t\t<a class=\"navbar-brand\" href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_index");
        echo "\">
\t\t\t<img src=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/amdie.png"), "html", null, true);
        echo "\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\t\t\talt=\"logo\">
\t\t\t\t<div class=\"SousTitre\">
\t\t\t\t<strong>AMDIE</strong>
\t\t\t|

\t\t\tIndex

\t\t\t</div>
\t\t</a>
\t\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 118
    public function block_header_search($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_search"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_search"));

        // line 119
        echo "\t\t\t";
        // line 123
        echo "
\t\t\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 254
    public function block_navbar_left($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 257
    public function block_navbar_right($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 264
    public function block_third_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "third_header"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "third_header"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 266
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 268
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  762 => 268,  744 => 266,  726 => 264,  708 => 257,  690 => 254,  679 => 123,  677 => 119,  667 => 118,  646 => 82,  641 => 81,  631 => 80,  596 => 40,  585 => 8,  575 => 7,  531 => 277,  519 => 269,  517 => 268,  514 => 267,  512 => 266,  509 => 265,  507 => 264,  499 => 258,  497 => 257,  493 => 255,  491 => 254,  476 => 242,  472 => 241,  468 => 239,  464 => 237,  460 => 236,  455 => 233,  447 => 228,  442 => 227,  438 => 225,  436 => 224,  433 => 223,  431 => 222,  428 => 221,  426 => 220,  423 => 219,  421 => 218,  418 => 217,  416 => 216,  413 => 215,  411 => 214,  408 => 213,  406 => 212,  403 => 211,  401 => 210,  398 => 209,  396 => 208,  393 => 207,  391 => 206,  388 => 205,  386 => 204,  383 => 203,  380 => 202,  369 => 191,  367 => 189,  363 => 187,  359 => 185,  353 => 182,  347 => 179,  339 => 176,  331 => 173,  328 => 172,  320 => 164,  313 => 160,  309 => 159,  302 => 157,  298 => 156,  291 => 154,  287 => 153,  280 => 151,  276 => 150,  269 => 148,  265 => 147,  258 => 145,  254 => 144,  247 => 142,  243 => 141,  236 => 139,  232 => 138,  225 => 136,  221 => 135,  213 => 129,  211 => 128,  207 => 126,  204 => 125,  201 => 118,  198 => 108,  196 => 107,  194 => 105,  181 => 93,  179 => 80,  172 => 75,  159 => 68,  153 => 64,  149 => 63,  140 => 59,  120 => 41,  117 => 40,  111 => 37,  107 => 36,  103 => 35,  97 => 31,  90 => 26,  87 => 25,  85 => 24,  81 => 23,  69 => 14,  63 => 10,  61 => 7,  53 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>

<head>
\t<meta charset=\"UTF-8\">
\t<title>
\t\t{% block title %}
\t\tIndex
\t\t{% endblock %}
\t\t| CRM AMDIE
\t</title>

\t<meta charset=\"utf-8\">
\t<link rel=\"icon\" type=\"image/png\" href=\"{{ asset('images/amdie.png') }}\" />
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\">
\t<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
\t<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js\"></script>
\t<link href=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css\" rel=\"stylesheet\" />
\t<script src=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js\"></script>
\t<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@10\"></script>
\t<script src=\"{{ asset('js/app.js') }}\"></script>
\t{% set currentRoute = app.request.attributes.get('_route') %}
\t{% if 'event' in currentRoute == false %}
\t<link rel=\"stylesheet\" type=\"text/css\"
\t\thref=\"https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.22/datatables.min.css\" />

\t<script type=\"text/javascript\" src=\"https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.22/datatables.min.js\"></script>
\t{% endif %}
\t<!-- Font Awesome -->
\t<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css\">
\t<!-- Ionicons -->
\t<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css\">
\t<link href=\"{{ asset('css/style.css') }}\" rel=\"stylesheet\" type=\"text/css\">
\t<link href=\"{{ asset('css/custom.css') }}\" rel=\"stylesheet\" type=\"text/css\">
\t<link href=\"{{ asset('css/style-responsive.css') }}\" rel=\"stylesheet\" type=\"text/css\">

\t<link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap\" rel=\"stylesheet\">
\t{% block stylesheets %}{% endblock %}{% block style %}{% endblock %}
\t<script>
\t\t\$(document).ready(function () {
\t\t\t\$(\".button\").click(function () {
\t\t\t\t\$(\".body-container\").addClass(\"modal-mobile\")
\t\t\t\t\$(\".modal-mobile\").fadeIn();
\t\t\t\t\$(\"row-wrape-filter-project\").css(\"overflow\", \"hidden\");
\t\t\t});
\t\t\t\$(\".cross\").click(function () {
\t\t\t\tconsole.log(\"test\");
\t\t\t\t\$(\".modal-mobile\").fadeOut();
\t\t\t\t\$(\"row-wrape-filter-project\").css(\"overflow\", \"auto\");
\t\t\t});
\t\t});
\t</script>


</head>

<body class=\"page_{{ currentRoute|lower }} {{ 'event' in currentRoute ? 'event' : '' }}\">
<div class=\"desktop\">

\t<!-- flash msg zone -->
\t{% for message in app.flashes('success') %}
\t<script>
\t\tSwal.fire({
\t\t\tposition: 'top-end',
\t\t\ticon: 'success',
\t\t\ttitle: '{{ message }}',
\t\t\tshowConfirmButton: false,
\t\t\ttimer: 3000
\t\t})
\t</script>

\t{% endfor %}

\t<!-- /flash msg zone -->
\t<div class=\"sticky\">
\t
\t<nav class=\"navbar navbar-expand-lg navbar-light bg-light menuMobile\">
\t{% block sous_title %}
\t\t<a class=\"navbar-brand\" href=\"{{ path('projets_index') }}\">
\t\t\t<img src=\"{{ asset('images/amdie.png') }}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\t\t\talt=\"logo\">
\t\t\t\t<div class=\"SousTitre\">
\t\t\t\t<strong>AMDIE</strong>
\t\t\t|

\t\t\tIndex

\t\t\t</div>
\t\t</a>
\t\t{% endblock %}
\t\t<div class=\"nav_toggle\">
\t\t\t<button class=\"nav-toggle\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\"
\t\t\t\taria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
\t\t\t\t<span class=\"nav-toggle__text\">Toggle Menu</span>
\t\t\t</button>
\t\t</div>


\t\t<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">

\t\t\t<ul class=\"navbar-nav mr-auto\"></ul>
\t\t\t{# <ul class=\"nav navbar-nav navbar-right\"> #}
\t\t\t{# <a href=\"{{ path('contact_site_amdie') }}\">
\t\t\t\t<div class=\"wrap-notification\"> #}
\t\t\t\t\t{# <img src=\"{{asset('images/icons/email.png')}}\" /> #}

\t\t\t\t\t{# <span class=\"notification-icon\" id=\"notification\">
\t\t\t\t\t\t{% if is_array(count) == \"false\" %}
\t\t\t\t\t\t{{ count }}
\t\t\t\t\t\t{% endif %}
\t\t\t\t\t</span>


\t\t\t\t</div>
\t\t\t</a> #}
\t\t\t{% block header_search %}
\t\t\t{# <form class=\"form-inline\" action=\"#\" method=\"get\">
\t\t\t\t<input class=\"form-control mr-sm-2\" name=\"search\" type=\"search\" placeholder=\"Chercher\"
\t\t\t\t\taria-label=\"Chercher\">
\t\t\t</form> #}

\t\t\t{% endblock %}
\t\t\t{% set currentRoute = app.request.attributes.get('_route') %}
\t\t\t<ul class=\"nav navbar-nav navbar-right main-menu\">

\t\t\t\t{% if app.user.groupe.id==1 %}
\t\t\t\t<li class=\"nav-item dropdown drop-list\">
\t\t\t\t\t<a class=\"nav-link-global dropdown-toggle current-page\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
\t\t\t\t\t\tdata-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t\t\tAdministration
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"dropdown-menu header-navbar\" aria-labelledby=\"navbarDropdown\">
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'user_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('user_index') }}\">{{ 'user.titre_user'| trans }}</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'role_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('role_index') }}\">{{ 'role.titre_role'| trans }}</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'restriction_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('restriction_index') }}\">{{ 'restriction.Restriction'| trans }}</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'groupe_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('groupe_index') }}\">{{ 'groupe.titre_groupe'| trans }}</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'permission_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('permission_index') }}\">{{ 'acces.Acces'| trans }}</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'secteur_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('secteur_index') }}\">{{ 'secteur.Secteur'| trans }}</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'profils_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('profils_index') }}\">{{ 'profil.Profils'| trans }}</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'canal_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('canal_index') }}\">{{ 'canal.Canals'| trans }}</a>
\t\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item {{ currentRoute == 'fonction_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('fonction_index') }}\">Fonction</a>
\t\t\t\t\t</div>
\t\t\t\t</li>
\t\t\t\t{% else %}
\t\t\t\t<li class=\"nav-item dropdown drop-list\">
\t\t\t\t\t<a class=\"nav-link-global dropdown-toggle current-page-user\" href=\"#\" id=\"navbarDropdown\"
\t\t\t\t\t\trole=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t\t\tGestion
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"dropdown-menu  header-navbar\" aria-labelledby=\"navbarDropdown\">
\t\t\t\t\t\t{# <a class=\"nav-link {{ currentRoute == 'contact_index' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('contact_index') }}\">{{ 'contact.Contacts'| trans }}</a> #}
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"{{ path('contact_index') }}\">{{ 'contact.Contacts'| trans }}</a>
\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"{{ path('compte_index') }}\">{{ 'compte.Compte'| trans }}</a>
\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"{{ path('partenaire_list') }}\">Partenaires</a>
\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"{{ path('projets_index') }}\">{{ 'projet.Projects'| trans }}</a>
\t\t\t\t\t\t{# <a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"{{ path('actions_index') }}\">Actions</a> #}
\t\t\t\t\t\t<div class=\"dropdown-divider\"></div>
\t\t\t\t\t\t<a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"{{ path('events_index') }}\">Events</a>
\t\t\t\t\t\t{# <div class=\"dropdown-divider\"></div> #}
\t\t\t\t\t\t{# <a class=\"dropdown-item\"
\t\t\t\t\t\t\thref=\"{{ path('emails_index') }}\">Emails</a> #}

\t\t\t\t\t</div>
\t\t\t\t</li>
\t\t\t\t<li class=\"nav-item dropdown drop-list\">
\t\t\t\t\t<a class=\"nav-link-global dropdown-toggle current-page\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
\t\t\t\t\t\tdata-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t\t\tConsole
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
\t\t\t\t\t\t{# <a class=\"nav-link {{ currentRoute == 'reporting' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('reporting') }}\">Analytics</a> #}
\t\t\t\t\t\t{% if app.user.groupe.nom == \"Business Developers Export\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/9T4VBWVWNX?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Business Developers Investissement\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/1gFrp52eTv?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Departement Investissement\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/1gFrp52eTv?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Directeur - GPAC\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/Ewcd7VhM0G?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Directeur Investissement\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/rp-epIKFEt?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Directeur-transverse\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/-MAJ1wO-oF?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkSharee\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Direction Générale - DG\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/SbrGxLCWvj?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Département Export\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/9T4VBWVWNX?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Gestion Directeur Export\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/9T4VBWVWNX?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Gestionnaires CRM & KPI\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/pI2AzABKG6?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Responsable-GPAC\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/Ewcd7VhM0G?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% elseif app.user.groupe.nom == \"Utilisateurs - transverses\" %}
\t\t\t\t\t\t<a class=\"nav-link\" target=\"_blank\" href=\"https://app.powerbi.com/links/-MAJ1wO-oF?ctid=1820ac0c-a642-4f86-b293-614635ce57b8&pbi_source=linkShare\">Analytics</a>
\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t<a class=\"nav-link {{ currentRoute == 'projets_dashbord' ?'active' : '' }}\"
\t\t\t\t\t\t\thref=\"{{ path('projets_dashbord') }}\">Dashbord</a>
\t\t\t\t\t</div>
\t\t\t\t</li>

\t\t\t\t{% endif %}
\t\t\t\t<li class=\"nav-item dropdown drop-list\">
\t\t\t\t\t<a class=\"nav-link-global dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
\t\t\t\t\t\tdata-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t\t\t{{ app.user.prenom|capitalize }}
\t\t\t\t\t\t{{ app.user.nom|upper }}
\t\t\t\t\t\t{# {{ app.user.nom|first|upper }} #}
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
\t\t\t\t\t\t<a class=\"dropdown-item\" href=\"{{ path('user_edit_profile',{ 'id': app.user.id }) }}\">Mon Profile</a>
\t\t\t\t\t\t<a class=\"dropdown-item\" href=\"{{ path('app_logout') }}\">Déconnexion</a>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t</li>
\t\t\t</ul>

\t\t</div>
\t</nav>

\t<nav class=\"navbar navbar-expand-lg navbar-light navbar-blue transaction\">

\t\t<div class=\"collapse navbar-collapse\">
\t\t\t<ul class=\"navbar-nav mr-auto\"> {% block navbar_left %}{% endblock %}
\t\t\t</ul>

\t\t\t<ul class=\"nav navbar-nav navbar-right\"> {% block navbar_right %}{% endblock %}
\t\t\t</ul>

\t\t</div>
\t</nav>
\t</div>
\t<div class=\"contentst\">
\t{% block third_header %}{% endblock %}
\t</div>
\t<div class=\"container-dash\" width=\" 100%\"> {% block body %}{% endblock %}
\t</div>
\t{% block javascripts %}{% endblock %}
\t<script src=\"{{ asset('js/dom.js') }}\"></script>
\t<div class=\"clear\"></div>
\t<link href=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css\" rel=\"stylesheet\" />
\t<script src=\"https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js\"></script>
\t<script src=\"https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js\"></script>
\t<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css\" />
\t<script src=\"{{ asset('js/custom.js') }}\"></script>
\t<script>
\t\t\$(document).ready(function () {
\t\t\tbsCustomFileInput.init()
\t\t})
\t</script>
</div>
<div class=\"mobile\">
<div class=\"row\">
\t\t\t<div class=\"col-lg-12 col-md-6\">
\t\t\t\t<div class=\"descLogin\">
\t\t\t\t\t<div>
\t\t\t\t\t\t<img src=\"/images/illustration.png\" alt=\"\" style=\"position: relative;width: 100%;\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"\">
\t\t\t\t\t\t  <img src=\"/images/logoAmdie.png\" alt=\"\"  style=\"display: block;margin-left: auto;margin-right: auto;width: 50%\";>
\t\t\t\t\t  </div>
\t\t\t\t\t<div class=\"textLogin\">
\t\t\t\t\t\t<div class=\"titre-textLogin\">
\t\t\t\t\t\t\t<h1> Doing business with Morocco </h1>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"desc-textLogin\" style=\"text-align: justify;\">
\t\t\t\t\t\t\t<p> Cette solution CRM vise à suivre le funnel commercial des clients à prospecter par l'AMDIE </p>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
</div>\t
</div>
</body>

</html>
", "base.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/base.html.twig");
    }
}
