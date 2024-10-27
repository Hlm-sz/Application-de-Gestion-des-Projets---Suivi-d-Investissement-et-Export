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

/* projets/dashbord/index.html.twig */
class __TwigTemplate_d65a95cfe805d254b497257b1976bc42766079780cef71dfc3a1f190b090e305 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'sous_title' => [$this, 'block_sous_title'],
            'header_search' => [$this, 'block_header_search'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'navbar_right' => [$this, 'block_navbar_right'],
            'navbar_left' => [$this, 'block_navbar_left'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "projets/dashbord/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "projets/dashbord/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "projets/dashbord/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        // line 4
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("projet.listes_projet"), "html", null, true);
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 6
    public function block_sous_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sous_title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sous_title"));

        // line 7
        echo "<a class=\"navbar-brand\" href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_dashbord");
        echo "\">
\t<img src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/amdie.png"), "html", null, true);
        echo "\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\talt=\"logo\">
\t\t<div class=\"SousTitre\">
\t\t<strong>AMDIE</strong>
\t|
\t";
        // line 13
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("projet.titre_projet")), "html", null, true);
        echo "
\t</div>
</a>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 17
    public function block_header_search($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_search"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_search"));

        // line 18
        if ((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 18, $this->source); })())) {
            // line 19
            echo "
<form class=\"form-inline\" action=\"";
            // line 20
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_filtre", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 20, $this->source); })()), "id", [], "any", false, false, false, 20)]), "html", null, true);
            echo "\" method=\"get\">
\t";
        } else {
            // line 22
            echo "\t<form class=\"form-inline\" action=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_filtre");
            echo "\" method=\"get\">
\t\t";
        }
        // line 24
        echo "\t\t";
        // line 25
        echo "\t</form>
\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 27
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 28
        echo "\t<style type=\"text/css\">
\t\t/** Twitter Typeahead **/
\t\t.twitter-typeahead,
\t\t.typeahead,
\t\t.empty-message {
\t\t\twidth: 100%;
\t\t}
\t\t.tt-menu {
\t\t\tbackground: white;
\t\t\twidth: 100%;
\t\t}
\t\t.tt-suggestion {
\t\t\toverflow: hidden;
\t\t\tdisplay: table;
\t\t\twidth: 100%;
\t\t\tpadding: 10px 10px;
\t\t\tborder-bottom: 1px solid #e9ecf2;
\t\t}
\t\t/** Movie Card (Movie Suggestions) **/
\t\t.movie-card {
\t\t\tposition: relative;
\t\t\tpadding: 8px;
\t\t}
\t\t.movie-card-poster {
\t\t\tposition: absolute;
\t\t\ttop: 8px;
\t\t\tleft: 8px;
\t\t\twidth: 52px;
\t\t\theight: 52px;
\t\t\tborder: 2px solid #ccd6dd;
\t\t\tborder-radius: 5px;
\t\t}
\t\t.movie-card:hover .movie-card-poster {
\t\t\tborder-color: #f5f8fa;
\t\t}
\t\t.movie-card-details {
\t\t\tmin-height: 60px;
\t\t\tpadding-left: 60px;
\t\t}
\t\t.movie-card-name,
\t\t.movie-card-year {
\t\t\tdisplay: inline-block;
\t\t}
\t\t.movie-card-name {
\t\t\tfont-weight: 700;
\t\t}
\t\t.movie-card-year {
\t\t\tcolor: #8899a6;
\t\t}

\t\t.movie-card:hover .movie-card-year {
\t\t\tcolor: #fff;
\t\t}

\t\t.movie-card-plot {
\t\t\tmargin-top: 5px;
\t\t\tfont-size: 14px;
\t\t\tline-height: 18px;
\t\t}

\t\t.movie-card:hover,
\t\t.movie-card.is-active {
\t\t\tcolor: #fff;
\t\t\tbackground: #0088CC;
\t\t\tcursor: pointer;
\t\t}
\t\t.empty-message {
\t\t\tposition: relative;
\t\t\tpadding: 10px;
\t\t\tfont-size: 16px;
\t\t\tline-height: 30px;
\t\t\ttext-align: center;
\t\t}
\t</style>
\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 103
    public function block_navbar_right($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        // line 104
        echo "\t<li class=\"nav-item\">
\t\t<div class=\"dropdown\">
\t\t\t<button class=\"btn btn-blue \" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
\t\t\t\taria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t<i class=\"fa fa-plus\"></i>
\t\t\t</button>
\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
\t\t\t";
        // line 111
        if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 111, $this->source); })()), "user", [], "any", false, false, false, 111), "groupe", [], "any", false, false, false, 111), "nom", [], "any", false, false, false, 111), "Directeur Secteur Invest"))) {
            // line 112
            echo "                <a class=\"dropdown-item\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 1]);
            echo "\">Projet investissement</a>
            ";
        } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 113
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 113, $this->source); })()), "user", [], "any", false, false, false, 113), "groupe", [], "any", false, false, false, 113), "nom", [], "any", false, false, false, 113), "Directeur Secteur Export et sourcing"))) {
            // line 114
            echo "            <a class=\"dropdown-item\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 2]);
            echo "\">Projet sourcing</a>
\t\t\t    <a class=\"dropdown-item\" href=\"";
            // line 115
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 3]);
            echo "\">Projet export</a>
            ";
        } else {
            // line 117
            echo "                <a class=\"dropdown-item\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 1]);
            echo "\">Projet investissement</a>
\t\t\t    <a class=\"dropdown-item\" href=\"";
            // line 118
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 2]);
            echo "\">Projet sourcing</a>
\t\t\t    <a class=\"dropdown-item\" href=\"";
            // line 119
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 3]);
            echo "\">Projet export</a>
            ";
        }
        // line 121
        echo "\t\t\t</div>
\t\t</div>
\t</li>
\t";
        // line 124
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("EXTRACTIONS_PROJETS", (isset($context["type_projet"]) || array_key_exists("type_projet", $context) ? $context["type_projet"] : (function () { throw new RuntimeError('Variable "type_projet" does not exist.', 124, $this->source); })()))) {
            // line 125
            echo "\t\t<a class=\"btn btn-blue\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_export");
            echo "\"> <i class=\"fa fa-download\"></i> </a> 
    ";
        }
        // line 127
        echo "
\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 129
    public function block_navbar_left($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        // line 130
        echo "\t<li class=\"nav-item nav-item-secteur\">
\t\t<div class=\"dropdown\">
\t\t\t<button class=\"btn btn-blue dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
\t\t\t\taria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t<span
\t\t\t\t\tstyle=\"border-bottom: 3px solid ";
        // line 135
        (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 135, $this->source); })())) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 135, $this->source); })()), "color", [], "any", false, false, false, 135), "html", null, true))) : (print ("#fff")));
        echo "\">";
        (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 135, $this->source); })())) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 135, $this->source); })()), "nom", [], "any", false, false, false, 135), "html", null, true))) : (print ("Secteurs")));
        echo "</span>
\t\t\t</button>
\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
\t\t\t\t";
        // line 138
        if ((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 138, $this->source); })())) {
            // line 139
            echo "\t\t\t\t<a class=\"dropdown-item list-secteurs\" href=\"#\" data-secteur=\"\">Secteurs</a>
\t\t\t\t";
        }
        // line 141
        echo "
\t\t\t\t";
        // line 142
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["listeSecteurs"]) || array_key_exists("listeSecteurs", $context) ? $context["listeSecteurs"] : (function () { throw new RuntimeError('Variable "listeSecteurs" does not exist.', 142, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["secteur"]) {
            // line 143
            echo "
\t\t\t\t";
            // line 144
            if (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 144, $this->source); })()) && (0 === twig_compare(twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 144, $this->source); })()), "id", [], "any", false, false, false, 144), twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 144))))) {
                // line 145
                echo "\t\t\t\t<a class=\"dropdown-item d-none list-secteurs\" data-secteur=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 145), "html", null, true);
                echo "\"
\t\t\t\t\thref=\"#\">";
                // line 146
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "nom", [], "any", false, false, false, 146), "html", null, true);
                echo "</a>
\t\t\t\t";
            } else {
                // line 148
                echo "\t\t\t\t<a class=\"dropdown-item list-secteurs\" data-secteur=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 148), "html", null, true);
                echo "\" href=\"#\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "nom", [], "any", false, false, false, 148), "html", null, true);
                echo "</a>
\t\t\t\t";
            }
            // line 150
            echo "\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['secteur'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 151
        echo "\t\t\t\t";
        // line 154
        echo "\t\t\t</div>
\t\t</div>
\t</li>
\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 158
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 159
        echo "
\t<div class=\"row main main-dashboard\">
\t\t<div class=\"col-md-1  wrape-filter-project\">
\t\t\t<div class=\"filter-project\">
\t\t\t\t<a class=\"btn-filtre\" onclick=\"document.querySelector('.main-projects').style.transition='all .3s'; document.querySelector('.main-projects').style.transform == 'translateX(0px)' || !document.querySelector('.main-projects').style.transform ? (document.querySelector('.main-projects').style.transform = 'translateX(310px)') : (document.querySelector('.main-projects').style.transform = 'translateX(0)')\">
\t\t\t\t\t<img class=\"img-filtre\" src=\"";
        // line 164
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/filter-project.svg"), "html", null, true);
        echo "\" alt=\"\">
\t\t\t\t</a>
\t\t\t\t<div class=\"sidebare-filter \">
\t\t\t\t\t";
        // line 167
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 167, $this->source); })()), 'form_start', ["attr" => ["id" => "form_filtre"]]);
        echo "
\t\t\t\t\t";
        // line 168
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 168, $this->source); })()), 'widget');
        echo "
\t\t\t\t\t<button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
\t\t\t\t\t";
        // line 170
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 170, $this->source); })()), 'form_end');
        echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-11 main-projects dash\">
\t\t\t\t<div class=\"row wrapper\">
\t\t\t\t\t";
        // line 176
        $context["countProjet"] = 0;
        // line 177
        echo "\t\t\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["secteurs"]) || array_key_exists("secteurs", $context) ? $context["secteurs"] : (function () { throw new RuntimeError('Variable "secteurs" does not exist.', 177, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["secteur"]) {
            // line 178
            echo "\t\t\t\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["secteur"], "projets", [], "any", false, false, false, 178)) {
                // line 179
                echo "\t\t\t\t\t";
                $context["countProjet"] = 1;
                // line 180
                echo "\t\t\t\t\t<div class=\"col-lg-3  wrape-project\">
\t\t\t\t\t\t<div class=\"header project-topsection\" style=\"border-bottom: 6px solid ";
                // line 181
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "color", [], "any", false, false, false, 181), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t<h1>";
                // line 182
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "nom", [], "any", false, false, false, 182), "html", null, true);
                echo " (";
                echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "projets", [], "any", false, false, false, 182)), "html", null, true);
                echo ")</h1>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"content parent-ajax\">
\t\t\t\t\t\t\t<ul class=\"list-group \" id=\"list-project\">
\t\t\t\t\t\t\t\t";
                // line 186
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["secteur"], "projets", [], "any", false, false, false, 186));
                foreach ($context['_seq'] as $context["_key"] => $context["projet"]) {
                    // line 187
                    echo "\t\t\t\t\t\t\t\t<li class=\"list-group-item itm scroll-dashbord\" data-source=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_show", ["id" => twig_get_attribute($this->env, $this->source, $context["projet"], "id", [], "any", false, false, false, 187)]), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t\t<span class=\"random-color\" id=\"random-color\"></span> ";
                    // line 188
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["projet"], "titre", [], "any", false, false, false, 188), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['projet'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 191
                echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t";
            }
            // line 195
            echo "\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['secteur'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 196
        echo "\t\t\t\t</div>
\t\t\t\t";
        // line 197
        if ((0 === twig_compare((isset($context["countProjet"]) || array_key_exists("countProjet", $context) ? $context["countProjet"] : (function () { throw new RuntimeError('Variable "countProjet" does not exist.', 197, $this->source); })()), 0))) {
            // line 198
            echo "\t\t\t\t<div>
\t\t\t\t\t<div class=\"col-lg-12  body-container\">
\t\t\t\t\t\t<div class=\"container\">
\t\t\t\t\t\t\t<div class=\"item-details-empty\">
\t\t\t\t\t\t\t\t<img src=\"";
            // line 202
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/dashboard.png"), "html", null, true);
            echo "\" class=\"img-fluid\">
\t\t\t\t\t\t\t\t<h3>Aucun projet trouvé</h3>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t";
        } else {
            // line 209
            echo "\t\t\t\t<div class=\"detail-projects   \">
\t\t\t\t\t<div id=\"item-details-wrapper\" >

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t";
        }
        // line 215
        echo "
\t\t</div >
\t</div>
\t<button class=\"scroltop\" >
\t<i class=\"fa fa-angle-double-up\"></i>
\t</button>
\t";
        // line 221
        $this->displayBlock('javascripts', $context, $blocks);
        // line 222
        echo "\t<script>
\t\tjQuery(document).ready(function (\$) {
\t\t\t\$(document).on('click', '.list-secteurs', function (e) {
\t\t\t\te.preventDefault();
\t\t\t\tvar secteur = \$(this).data('secteur');
\t\t\t\t\$('#secteur').val(secteur);
\t\t\t\t//console.log(source);
\t\t\t\t\$(\"#telecharger\").remove();
\t\t\t\t\$('#form_filtre').submit();
\t\t\t})
\t\t\t\$(document).on('click', '.download', function (e) {
\t\t\t\te.preventDefault();
\t\t\t\t\$('#form_filtre').append(
\t\t\t\t\t'<input type=\"hidden\" id=\"telecharger\" name=\"telecharger\" value=\"1\">');
\t\t\t\t\$('#form_filtre').submit();
\t\t\t})
\t\t\t\$(document).on('click', '.tri', function (e) {
\t\t\t\te.preventDefault();
\t\t\t\tvar tri = \$(this).data('tri');
\t\t\t\t\$('#tri').val(tri);
\t\t\t\t\$(\"#telecharger\").remove();
\t\t\t\t// console.log(tri);
\t\t\t\t\$('#form_filtre').submit();
\t\t\t})
\t\t\t\$(\"#filtre\").click(function (e) {
\t\t\t\te.preventDefault();
\t\t\t\t\$(\"#telecharger\").remove();
\t\t\t\tchangeAutocomplate();
\t\t\t\t\$(\"#form_filtre\").submit();

\t\t\t});

\t\t\tfunction changeAutocomplate() {
\t\t\t\tif (\$('#compte_filtre').val() == '') {
\t\t\t\t\t//alert(\$('#compte_filtre').val());
\t\t\t\t\t\$('#compte').val('');
\t\t\t\t}
\t\t\t\tif (\$('#user_filtre').val() == '') {
\t\t\t\t\t//alert(\$('#user_filtre').val());
\t\t\t\t\t\$('#gerePar').val('');
\t\t\t\t}

\t\t\t}

\t\t})
\t</script>
\t<script type=\"text/javascript\" src=\"";
        // line 268
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bloodhound.jquery.min.js"), "html", null, true);
        echo "\"></script>
\t<script type=\"text/javascript\" src=\"";
        // line 269
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/typeahead.jquery.min.js"), "html", null, true);
        echo "\"></script>
\t<script type=\"text/javascript\">
\t\t\$(document).ready(function () {
\t\t\tvar states = new Bloodhound({
\t\t\t\tdatumTokenizer: Bloodhound.tokenizers.whitespace,
\t\t\t\tqueryTokenizer: Bloodhound.tokenizers.whitespace,
\t\t\t\tremote: {
\t\t\t\t\turl: \"";
        // line 276
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("handle_search_compte");
        echo "/%QUERY%\",
\t\t\t\t\twildcard: '%QUERY%',
\t\t\t\t\tfilter: function (states) {
\t\t\t\t\t\treturn \$.map(states, function (state) {
\t\t\t\t\t\t\treturn {
\t\t\t\t\t\t\t\tstate_id: state.id,
\t\t\t\t\t\t\t\tnomCompte: state.nomCompte,
\t\t\t\t\t\t\t}
\t\t\t\t\t\t})
\t\t\t\t\t}
\t\t\t\t}
\t\t\t})
\t\t\tstates.initialize();

\t\t\t\$('#compte_filtre').typeahead({
\t\t\t\thint: true
\t\t\t}, {
\t\t\t\tname: 'states',
\t\t\t\tsource: states.ttAdapter(),
\t\t\t\tdisplay: 'nomCompte',
\t\t\t\ttemplates: {
\t\t\t\t\tsuggestion: function (data) {
\t\t\t\t\t\treturn `
                                <div>
                                    <strong>` + data.nomCompte + `</strong>
                                </div>
                       `
\t\t\t\t\t}
\t\t\t\t}
\t\t\t})
\t\t\t\$('#compte_filtre').bind('typeahead:select', function (ev, suggestion) {
\t\t\t\t\$(\"#compte\").val(suggestion.state_id);
\t\t\t});
\t\t})
\t</script>
\t<script type=\"text/javascript\">
\t\t\$(document).ready(function () {
\t\t\tvar users = new Bloodhound({
\t\t\t\tdatumTokenizer: Bloodhound.tokenizers.whitespace,
\t\t\t\tqueryTokenizer: Bloodhound.tokenizers.whitespace,
\t\t\t\tremote: {
\t\t\t\t\turl: \"";
        // line 317
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("handle_search_users");
        echo "/%QUERY%\",
\t\t\t\t\twildcard: '%QUERY%',
\t\t\t\t\tfilter: function (users) {
\t\t\t\t\t\treturn \$.map(users, function (user) {
\t\t\t\t\t\t\treturn {
\t\t\t\t\t\t\t\tuser_id: user.id,
\t\t\t\t\t\t\t\tnomUser: user.prenom + ' ' + user.nom,
\t\t\t\t\t\t\t}
\t\t\t\t\t\t})
\t\t\t\t\t}
\t\t\t\t}
\t\t\t})
\t\t\tusers.initialize();

\t\t\t\$('#user_filtre').typeahead({
\t\t\t\thint: true
\t\t\t}, {
\t\t\t\tname: 'users',
\t\t\t\tsource: users.ttAdapter(),
\t\t\t\tdisplay: 'nomUser',
\t\t\t\ttemplates: {
\t\t\t\t\tsuggestion: function (data) {
\t\t\t\t\t\treturn `
                                <div>
                                    <strong>` + data.nomUser + `</strong>
                                </div>
                            `
\t\t\t\t\t}
\t\t\t\t}
\t\t\t})
\t\t\t\$('#user_filtre').bind('typeahead:select', function (ev, suggestion) {
\t\t\t\t//console.table( suggestion.state_id);
\t\t\t\t\$(\"#gerePar\").val(suggestion.user_id);
\t\t\t});
\t\t})
\t</script>

\t";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 221
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
        return "projets/dashbord/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  708 => 221,  660 => 317,  616 => 276,  606 => 269,  602 => 268,  554 => 222,  552 => 221,  544 => 215,  536 => 209,  526 => 202,  520 => 198,  518 => 197,  515 => 196,  509 => 195,  503 => 191,  494 => 188,  489 => 187,  485 => 186,  476 => 182,  472 => 181,  469 => 180,  466 => 179,  463 => 178,  458 => 177,  456 => 176,  447 => 170,  442 => 168,  438 => 167,  432 => 164,  425 => 159,  415 => 158,  402 => 154,  400 => 151,  394 => 150,  386 => 148,  381 => 146,  376 => 145,  374 => 144,  371 => 143,  367 => 142,  364 => 141,  360 => 139,  358 => 138,  350 => 135,  343 => 130,  333 => 129,  322 => 127,  316 => 125,  314 => 124,  309 => 121,  304 => 119,  300 => 118,  295 => 117,  290 => 115,  285 => 114,  283 => 113,  278 => 112,  276 => 111,  267 => 104,  257 => 103,  173 => 28,  163 => 27,  152 => 25,  150 => 24,  144 => 22,  139 => 20,  136 => 19,  134 => 18,  124 => 17,  110 => 13,  102 => 8,  97 => 7,  87 => 6,  75 => 4,  65 => 3,  42 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}
{{ 'projet.listes_projet'| trans }}
{% endblock %}
{% block sous_title %}
<a class=\"navbar-brand\" href=\"{{ path('projets_dashbord') }}\">
\t<img src=\"{{ asset('images/amdie.png') }}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\talt=\"logo\">
\t\t<div class=\"SousTitre\">
\t\t<strong>AMDIE</strong>
\t|
\t{{ 'projet.titre_projet'| trans | upper }}
\t</div>
</a>
{% endblock %}
{% block header_search %}
{% if secteur_active %}

<form class=\"form-inline\" action=\"{{ path('projets_filtre',{'id':secteur_active.id}) }}\" method=\"get\">
\t{% else %}
\t<form class=\"form-inline\" action=\"{{ path('projets_filtre') }}\" method=\"get\">
\t\t{% endif %}
\t\t{# <input class=\"form-control mr-sm-2\" name=\"search\" type=\"search\" placeholder=\"Chercher\" aria-label=\"Chercher\"> #}
\t</form>
\t{% endblock %}
\t{% block stylesheets %}
\t<style type=\"text/css\">
\t\t/** Twitter Typeahead **/
\t\t.twitter-typeahead,
\t\t.typeahead,
\t\t.empty-message {
\t\t\twidth: 100%;
\t\t}
\t\t.tt-menu {
\t\t\tbackground: white;
\t\t\twidth: 100%;
\t\t}
\t\t.tt-suggestion {
\t\t\toverflow: hidden;
\t\t\tdisplay: table;
\t\t\twidth: 100%;
\t\t\tpadding: 10px 10px;
\t\t\tborder-bottom: 1px solid #e9ecf2;
\t\t}
\t\t/** Movie Card (Movie Suggestions) **/
\t\t.movie-card {
\t\t\tposition: relative;
\t\t\tpadding: 8px;
\t\t}
\t\t.movie-card-poster {
\t\t\tposition: absolute;
\t\t\ttop: 8px;
\t\t\tleft: 8px;
\t\t\twidth: 52px;
\t\t\theight: 52px;
\t\t\tborder: 2px solid #ccd6dd;
\t\t\tborder-radius: 5px;
\t\t}
\t\t.movie-card:hover .movie-card-poster {
\t\t\tborder-color: #f5f8fa;
\t\t}
\t\t.movie-card-details {
\t\t\tmin-height: 60px;
\t\t\tpadding-left: 60px;
\t\t}
\t\t.movie-card-name,
\t\t.movie-card-year {
\t\t\tdisplay: inline-block;
\t\t}
\t\t.movie-card-name {
\t\t\tfont-weight: 700;
\t\t}
\t\t.movie-card-year {
\t\t\tcolor: #8899a6;
\t\t}

\t\t.movie-card:hover .movie-card-year {
\t\t\tcolor: #fff;
\t\t}

\t\t.movie-card-plot {
\t\t\tmargin-top: 5px;
\t\t\tfont-size: 14px;
\t\t\tline-height: 18px;
\t\t}

\t\t.movie-card:hover,
\t\t.movie-card.is-active {
\t\t\tcolor: #fff;
\t\t\tbackground: #0088CC;
\t\t\tcursor: pointer;
\t\t}
\t\t.empty-message {
\t\t\tposition: relative;
\t\t\tpadding: 10px;
\t\t\tfont-size: 16px;
\t\t\tline-height: 30px;
\t\t\ttext-align: center;
\t\t}
\t</style>
\t{% endblock %}
\t{% block navbar_right %}
\t<li class=\"nav-item\">
\t\t<div class=\"dropdown\">
\t\t\t<button class=\"btn btn-blue \" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
\t\t\t\taria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t<i class=\"fa fa-plus\"></i>
\t\t\t</button>
\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
\t\t\t{% if app.user.groupe.nom == \"Directeur Secteur Invest\" %}
                <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 1 }) }}\">Projet investissement</a>
            {% elseif app.user.groupe.nom == \"Directeur Secteur Export et sourcing\" %}
            <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 2 }) }}\">Projet sourcing</a>
\t\t\t    <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 3 }) }}\">Projet export</a>
            {% else %}
                <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 1 }) }}\">Projet investissement</a>
\t\t\t    <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 2 }) }}\">Projet sourcing</a>
\t\t\t    <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 3 }) }}\">Projet export</a>
            {% endif %}
\t\t\t</div>
\t\t</div>
\t</li>
\t{% if is_granted('EXTRACTIONS_PROJETS', type_projet) %}
\t\t<a class=\"btn btn-blue\" href=\"{{ path('projets_export') }}\"> <i class=\"fa fa-download\"></i> </a> 
    {% endif %}

\t{% endblock %}
\t{% block navbar_left %}
\t<li class=\"nav-item nav-item-secteur\">
\t\t<div class=\"dropdown\">
\t\t\t<button class=\"btn btn-blue dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
\t\t\t\taria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t<span
\t\t\t\t\tstyle=\"border-bottom: 3px solid {{ secteur_active ? secteur_active.color : '#fff' }}\">{{ secteur_active ? secteur_active.nom : 'Secteurs' }}</span>
\t\t\t</button>
\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
\t\t\t\t{% if secteur_active %}
\t\t\t\t<a class=\"dropdown-item list-secteurs\" href=\"#\" data-secteur=\"\">Secteurs</a>
\t\t\t\t{% endif %}

\t\t\t\t{% for secteur in listeSecteurs %}

\t\t\t\t{% if secteur_active and secteur_active.id == secteur.id %}
\t\t\t\t<a class=\"dropdown-item d-none list-secteurs\" data-secteur=\"{{ secteur.id }}\"
\t\t\t\t\thref=\"#\">{{ secteur.nom }}</a>
\t\t\t\t{% else %}
\t\t\t\t<a class=\"dropdown-item list-secteurs\" data-secteur=\"{{ secteur.id }}\" href=\"#\">{{ secteur.nom }}</a>
\t\t\t\t{% endif %}
\t\t\t\t{% endfor %}
\t\t\t\t{# {% for type in type_projet %}
\t\t\t\t\t<a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : type.id }) }}\">{{ type.nom }}</a>
\t\t\t\t{% endfor %} #}
\t\t\t</div>
\t\t</div>
\t</li>
\t{% endblock %}
\t{% block body %}

\t<div class=\"row main main-dashboard\">
\t\t<div class=\"col-md-1  wrape-filter-project\">
\t\t\t<div class=\"filter-project\">
\t\t\t\t<a class=\"btn-filtre\" onclick=\"document.querySelector('.main-projects').style.transition='all .3s'; document.querySelector('.main-projects').style.transform == 'translateX(0px)' || !document.querySelector('.main-projects').style.transform ? (document.querySelector('.main-projects').style.transform = 'translateX(310px)') : (document.querySelector('.main-projects').style.transform = 'translateX(0)')\">
\t\t\t\t\t<img class=\"img-filtre\" src=\"{{ asset('images/icons/filter-project.svg') }}\" alt=\"\">
\t\t\t\t</a>
\t\t\t\t<div class=\"sidebare-filter \">
\t\t\t\t\t{{ form_start(form,{'attr':{'id':'form_filtre'}}) }}
\t\t\t\t\t{{ form_widget(form) }}
\t\t\t\t\t<button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
\t\t\t\t\t{{ form_end(form) }}
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-11 main-projects dash\">
\t\t\t\t<div class=\"row wrapper\">
\t\t\t\t\t{% set countProjet = 0  %}
\t\t\t\t\t{% for secteur in secteurs %}
\t\t\t\t\t{% if secteur.projets %}
\t\t\t\t\t{% set countProjet = 1  %}
\t\t\t\t\t<div class=\"col-lg-3  wrape-project\">
\t\t\t\t\t\t<div class=\"header project-topsection\" style=\"border-bottom: 6px solid {{ secteur.color }}\">
\t\t\t\t\t\t\t<h1>{{ secteur.nom }} ({{ secteur.projets |length }})</h1>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"content parent-ajax\">
\t\t\t\t\t\t\t<ul class=\"list-group \" id=\"list-project\">
\t\t\t\t\t\t\t\t{% for projet in secteur.projets %}
\t\t\t\t\t\t\t\t<li class=\"list-group-item itm scroll-dashbord\" data-source=\"{{ path('projets_show', {'id': projet.id }) }}\">
\t\t\t\t\t\t\t\t\t<span class=\"random-color\" id=\"random-color\"></span> {{ projet.titre }}
\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t{% endif %}
\t\t\t\t\t{% endfor %}
\t\t\t\t</div>
\t\t\t\t{% if countProjet == 0 %}
\t\t\t\t<div>
\t\t\t\t\t<div class=\"col-lg-12  body-container\">
\t\t\t\t\t\t<div class=\"container\">
\t\t\t\t\t\t\t<div class=\"item-details-empty\">
\t\t\t\t\t\t\t\t<img src=\"{{ asset('images/dashboard.png') }}\" class=\"img-fluid\">
\t\t\t\t\t\t\t\t<h3>Aucun projet trouvé</h3>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t{% else %}
\t\t\t\t<div class=\"detail-projects   \">
\t\t\t\t\t<div id=\"item-details-wrapper\" >

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t{% endif %}

\t\t</div >
\t</div>
\t<button class=\"scroltop\" >
\t<i class=\"fa fa-angle-double-up\"></i>
\t</button>
\t{% block javascripts %}{% endblock %}
\t<script>
\t\tjQuery(document).ready(function (\$) {
\t\t\t\$(document).on('click', '.list-secteurs', function (e) {
\t\t\t\te.preventDefault();
\t\t\t\tvar secteur = \$(this).data('secteur');
\t\t\t\t\$('#secteur').val(secteur);
\t\t\t\t//console.log(source);
\t\t\t\t\$(\"#telecharger\").remove();
\t\t\t\t\$('#form_filtre').submit();
\t\t\t})
\t\t\t\$(document).on('click', '.download', function (e) {
\t\t\t\te.preventDefault();
\t\t\t\t\$('#form_filtre').append(
\t\t\t\t\t'<input type=\"hidden\" id=\"telecharger\" name=\"telecharger\" value=\"1\">');
\t\t\t\t\$('#form_filtre').submit();
\t\t\t})
\t\t\t\$(document).on('click', '.tri', function (e) {
\t\t\t\te.preventDefault();
\t\t\t\tvar tri = \$(this).data('tri');
\t\t\t\t\$('#tri').val(tri);
\t\t\t\t\$(\"#telecharger\").remove();
\t\t\t\t// console.log(tri);
\t\t\t\t\$('#form_filtre').submit();
\t\t\t})
\t\t\t\$(\"#filtre\").click(function (e) {
\t\t\t\te.preventDefault();
\t\t\t\t\$(\"#telecharger\").remove();
\t\t\t\tchangeAutocomplate();
\t\t\t\t\$(\"#form_filtre\").submit();

\t\t\t});

\t\t\tfunction changeAutocomplate() {
\t\t\t\tif (\$('#compte_filtre').val() == '') {
\t\t\t\t\t//alert(\$('#compte_filtre').val());
\t\t\t\t\t\$('#compte').val('');
\t\t\t\t}
\t\t\t\tif (\$('#user_filtre').val() == '') {
\t\t\t\t\t//alert(\$('#user_filtre').val());
\t\t\t\t\t\$('#gerePar').val('');
\t\t\t\t}

\t\t\t}

\t\t})
\t</script>
\t<script type=\"text/javascript\" src=\"{{ asset('js/bloodhound.jquery.min.js') }}\"></script>
\t<script type=\"text/javascript\" src=\"{{ asset('js/typeahead.jquery.min.js') }}\"></script>
\t<script type=\"text/javascript\">
\t\t\$(document).ready(function () {
\t\t\tvar states = new Bloodhound({
\t\t\t\tdatumTokenizer: Bloodhound.tokenizers.whitespace,
\t\t\t\tqueryTokenizer: Bloodhound.tokenizers.whitespace,
\t\t\t\tremote: {
\t\t\t\t\turl: \"{{ path('handle_search_compte') }}/%QUERY%\",
\t\t\t\t\twildcard: '%QUERY%',
\t\t\t\t\tfilter: function (states) {
\t\t\t\t\t\treturn \$.map(states, function (state) {
\t\t\t\t\t\t\treturn {
\t\t\t\t\t\t\t\tstate_id: state.id,
\t\t\t\t\t\t\t\tnomCompte: state.nomCompte,
\t\t\t\t\t\t\t}
\t\t\t\t\t\t})
\t\t\t\t\t}
\t\t\t\t}
\t\t\t})
\t\t\tstates.initialize();

\t\t\t\$('#compte_filtre').typeahead({
\t\t\t\thint: true
\t\t\t}, {
\t\t\t\tname: 'states',
\t\t\t\tsource: states.ttAdapter(),
\t\t\t\tdisplay: 'nomCompte',
\t\t\t\ttemplates: {
\t\t\t\t\tsuggestion: function (data) {
\t\t\t\t\t\treturn `
                                <div>
                                    <strong>` + data.nomCompte + `</strong>
                                </div>
                       `
\t\t\t\t\t}
\t\t\t\t}
\t\t\t})
\t\t\t\$('#compte_filtre').bind('typeahead:select', function (ev, suggestion) {
\t\t\t\t\$(\"#compte\").val(suggestion.state_id);
\t\t\t});
\t\t})
\t</script>
\t<script type=\"text/javascript\">
\t\t\$(document).ready(function () {
\t\t\tvar users = new Bloodhound({
\t\t\t\tdatumTokenizer: Bloodhound.tokenizers.whitespace,
\t\t\t\tqueryTokenizer: Bloodhound.tokenizers.whitespace,
\t\t\t\tremote: {
\t\t\t\t\turl: \"{{ path('handle_search_users') }}/%QUERY%\",
\t\t\t\t\twildcard: '%QUERY%',
\t\t\t\t\tfilter: function (users) {
\t\t\t\t\t\treturn \$.map(users, function (user) {
\t\t\t\t\t\t\treturn {
\t\t\t\t\t\t\t\tuser_id: user.id,
\t\t\t\t\t\t\t\tnomUser: user.prenom + ' ' + user.nom,
\t\t\t\t\t\t\t}
\t\t\t\t\t\t})
\t\t\t\t\t}
\t\t\t\t}
\t\t\t})
\t\t\tusers.initialize();

\t\t\t\$('#user_filtre').typeahead({
\t\t\t\thint: true
\t\t\t}, {
\t\t\t\tname: 'users',
\t\t\t\tsource: users.ttAdapter(),
\t\t\t\tdisplay: 'nomUser',
\t\t\t\ttemplates: {
\t\t\t\t\tsuggestion: function (data) {
\t\t\t\t\t\treturn `
                                <div>
                                    <strong>` + data.nomUser + `</strong>
                                </div>
                            `
\t\t\t\t\t}
\t\t\t\t}
\t\t\t})
\t\t\t\$('#user_filtre').bind('typeahead:select', function (ev, suggestion) {
\t\t\t\t//console.table( suggestion.state_id);
\t\t\t\t\$(\"#gerePar\").val(suggestion.user_id);
\t\t\t});
\t\t})
\t</script>

\t{% endblock %}
", "projets/dashbord/index.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/projets/dashbord/index.html.twig");
    }
}
