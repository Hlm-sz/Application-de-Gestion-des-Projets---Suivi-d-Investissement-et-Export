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

/* compte/indexparte.html.twig */
class __TwigTemplate_3ac4b22a119e9a7935ba7aff3e5edc3072d4bd8ddfcbfd5880d5aa3636c2b770 extends Template
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
            'navbar_right' => [$this, 'block_navbar_right'],
            'navbar_left' => [$this, 'block_navbar_left'],
            'body' => [$this, 'block_body'],
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "compte/indexparte.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "compte/indexparte.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "compte/indexparte.html.twig", 1);
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
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("compte.Liste_compte"), "html", null, true);
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 7
    public function block_sous_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sous_title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sous_title"));

        // line 8
        echo "<a class=\"navbar-brand\" href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("partenaire_list");
        echo "\">
\t<img src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/amdie.png"), "html", null, true);
        echo "\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\talt=\"logo\">
\t\t<div class=\"SousTitre\">
\t\t<strong>AMDIE</strong>
\t|
\t";
        // line 14
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, "Partenaires"), "html", null, true);
        echo "
\t</div>
</a>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 18
    public function block_header_search($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_search"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_search"));

        // line 19
        if ((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 19, $this->source); })())) {
            // line 20
            echo "<form class=\"form-inline\" action=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("compte_index", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 20, $this->source); })()), "id", [], "any", false, false, false, 20)]), "html", null, true);
            echo "\" method=\"get\">
\t";
        } else {
            // line 22
            echo "\t<form class=\"form-inline\" action=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("compte_index");
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
    public function block_navbar_right($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        // line 28
        echo "
<li class=\"nav-item\">
\t<div class=\"dropdown\" style=\"margin-right: 20px\">
\t\t";
        // line 31
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("EXTRACTIONS_PARTENAIRE", (isset($context["compte"]) || array_key_exists("compte", $context) ? $context["compte"] : (function () { throw new RuntimeError('Variable "compte" does not exist.', 31, $this->source); })()))) {
            // line 32
            echo "\t\t\t<a class=\"btn btn-blue\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("partenaires_export");
            echo "\">
\t\t\t\t<i class=\"fa fa-download\"></i>
\t\t\t</a>
\t\t";
        }
        // line 36
        echo "\t\t
\t\t";
        // line 40
        echo "
\t\t";
        // line 41
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("CREATION_DE_PARTENAIRE", (isset($context["compte"]) || array_key_exists("compte", $context) ? $context["compte"] : (function () { throw new RuntimeError('Variable "compte" does not exist.', 41, $this->source); })()))) {
            // line 42
            echo "\t\t\t<a class=\"btn btn-blue\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("part_new", ["id" => 4]);
            echo "\"><i class=\"fa fa-plus\"></i></a>
\t\t";
        }
        // line 44
        echo "\t</div>
</li>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 48
    public function block_navbar_left($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        // line 49
        echo "<li class=\"nav-item nav-item-secteur\">
\t\t<div class=\"dropdown\">
\t\t\t<button class=\"btn btn-blue dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
\t\t\t\taria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t<span
\t\t\t\t\tstyle=\"border-bottom: 3px solid ";
        // line 54
        (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 54, $this->source); })())) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 54, $this->source); })()), "color", [], "any", false, false, false, 54), "html", null, true))) : (print ("white")));
        echo "\">";
        (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 54, $this->source); })())) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 54, $this->source); })()), "nom", [], "any", false, false, false, 54), "html", null, true))) : (print ("Secteurs")));
        echo "</span>
\t\t\t</button>
\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
\t\t\t\t";
        // line 57
        if ((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 57, $this->source); })())) {
            // line 58
            echo "\t\t\t\t<a class=\"dropdown-item list-secteurs\" href=\"#\" data-secteur=\"\">Secteurs</a>
\t\t\t\t";
        }
        // line 60
        echo "
\t\t\t\t";
        // line 61
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["secteurs"]) || array_key_exists("secteurs", $context) ? $context["secteurs"] : (function () { throw new RuntimeError('Variable "secteurs" does not exist.', 61, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["secteur"]) {
            // line 62
            echo "
\t\t\t\t";
            // line 63
            if (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 63, $this->source); })()) && (0 === twig_compare(twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 63, $this->source); })()), "id", [], "any", false, false, false, 63), twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 63))))) {
                // line 64
                echo "\t\t\t\t<a class=\"dropdown-item d-none list-secteurs\" data-secteur=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 64), "html", null, true);
                echo "\"
\t\t\t\t\thref=\"#\">";
                // line 65
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "nom", [], "any", false, false, false, 65), "html", null, true);
                echo "</a>
\t\t\t\t";
            } else {
                // line 67
                echo "\t\t\t\t<a class=\"dropdown-item list-secteurs\" data-secteur=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 67), "html", null, true);
                echo "\" href=\"#\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "nom", [], "any", false, false, false, 67), "html", null, true);
                echo "</a>
\t\t\t\t";
            }
            // line 69
            echo "\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['secteur'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "\t\t\t</div>
\t\t</div>
\t</li>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 74
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 75
        echo "<div class=\"row main\">
\t<div class=\"col-md-1  wrape-filter-project\">
\t\t<div class=\"filter-project\">
\t\t\t<a class=\"btn-filtre\">
\t\t\t\t<img class=\"img-filtre\" src=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/filter-project.svg"), "html", null, true);
        echo "\" alt=\"\">
\t\t\t</a>
\t\t\t<div class=\"sidebare-filter \">
\t\t\t\t";
        // line 82
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 82, $this->source); })()), 'form_start', ["attr" => ["id" => "form_filtre"]]);
        echo "
\t\t\t\t\t";
        // line 83
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 83, $this->source); })()), 'widget');
        echo "
\t\t\t\t\t<button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
\t\t\t\t\t";
        // line 85
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 85, $this->source); })()), 'form_end');
        echo "
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"col-lg-11 main-projects\">
\t\t<div class=\"row wrapper\">
\t\t\t<div class=\"col-lg-3 wrape-list-project\">
\t\t\t\t<div class=\"items-container-header\">
\t\t\t\t\t<h3>Partenaires (";
        // line 93
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["comptes"]) || array_key_exists("comptes", $context) ? $context["comptes"] : (function () { throw new RuntimeError('Variable "comptes" does not exist.', 93, $this->source); })())), "html", null, true);
        echo ")</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"scroll_container_project\">
\t\t\t\t\t<div class=\"scroll_content_project parent-ajax\">
\t\t\t\t\t\t<ul id=\"list-compte\">
\t\t\t\t\t\t\t";
        // line 98
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["comptes"]) || array_key_exists("comptes", $context) ? $context["comptes"] : (function () { throw new RuntimeError('Variable "comptes" does not exist.', 98, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["compte"]) {
            // line 99
            echo "\t\t\t\t\t\t\t<li  class=\"list-compte scroll-btn\" data-id=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["compte"], "id", [], "any", false, false, false, 99), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\tdata-source=\"";
            // line 100
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("compte_show", ["id" => twig_get_attribute($this->env, $this->source, $context["compte"], "id", [], "any", false, false, false, 100)]), "html", null, true);
            echo "\">

\t\t\t\t\t\t\t\t<div class=\"content-list-comptes\">
\t\t\t\t\t\t\t\t\t<div class=\"content content_pro\">
\t\t\t\t\t\t\t\t\t\t<span class=\"item-logo\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"";
            // line 105
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . ((twig_get_attribute($this->env, $this->source, $context["compte"], "logo", [], "any", false, false, false, 105)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["compte"], "logo", [], "any", false, false, false, 105), "filename", [], "any", false, false, false, 105)) : ("logo_default.png")))), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t\t\talt=\"\" class=\"img-fluid\">
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"item-title\">
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 109
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["compte"], "nomCompte", [], "any", false, false, false, 109), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t <span class=\"item-date\">
                                            ";
            // line 112
            ((twig_get_attribute($this->env, $this->source, $context["compte"], "dateCreation", [], "any", false, false, false, 112)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["compte"], "dateCreation", [], "any", false, false, false, 112), "d/m/Y"), "html", null, true))) : (print ("")));
            echo "
                                        </span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['compte'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 118
        echo "\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-9  body-container\">
\t\t\t\t";
        // line 129
        echo "\t\t\t\t<div id=\"item-details-wrapper\" style=\"margin-left: 15px;\">
\t\t\t\t\t<div class=\"item-details-empty\">
\t\t\t\t\t\t<img src=\"";
        // line 131
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/dashboard.png"), "html", null, true);
        echo "\" class=\"img-fluid\">
\t\t\t\t\t\t<h3>Merci de sélectionner un partenaire</h3>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div> ";
        // line 138
        echo "</div> ";
        // line 139
        echo "
\t<button class=\"scroltop\">
\t<i class=\"fa fa-angle-double-up\"></i>
\t</button>
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


";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "compte/indexparte.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  405 => 139,  403 => 138,  394 => 131,  390 => 129,  383 => 118,  371 => 112,  365 => 109,  358 => 105,  350 => 100,  345 => 99,  341 => 98,  333 => 93,  322 => 85,  317 => 83,  313 => 82,  307 => 79,  301 => 75,  291 => 74,  278 => 70,  272 => 69,  264 => 67,  259 => 65,  254 => 64,  252 => 63,  249 => 62,  245 => 61,  242 => 60,  238 => 58,  236 => 57,  228 => 54,  221 => 49,  211 => 48,  198 => 44,  192 => 42,  190 => 41,  187 => 40,  184 => 36,  176 => 32,  174 => 31,  169 => 28,  159 => 27,  148 => 25,  146 => 24,  140 => 22,  134 => 20,  132 => 19,  122 => 18,  108 => 14,  100 => 9,  95 => 8,  85 => 7,  73 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}
{{'compte.Liste_compte'| trans}}
{% endblock %}

{% block sous_title %}
<a class=\"navbar-brand\" href=\"{{ path('partenaire_list') }}\">
\t<img src=\"{{ asset('images/amdie.png') }}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\talt=\"logo\">
\t\t<div class=\"SousTitre\">
\t\t<strong>AMDIE</strong>
\t|
\t{{ 'Partenaires' | upper }}
\t</div>
</a>
{% endblock %}
{% block header_search %}
{% if secteur_active %}
<form class=\"form-inline\" action=\"{{ path('compte_index',{'id':secteur_active.id}) }}\" method=\"get\">
\t{% else %}
\t<form class=\"form-inline\" action=\"{{ path('compte_index') }}\" method=\"get\">
\t\t{% endif %}
\t\t{# <input class=\"form-control mr-sm-2\" name=\"search\" type=\"search\" placeholder=\"Chercher\" aria-label=\"Chercher\"> #}
\t</form>
\t{% endblock %}
{% block navbar_right %}

<li class=\"nav-item\">
\t<div class=\"dropdown\" style=\"margin-right: 20px\">
\t\t{% if is_granted('EXTRACTIONS_PARTENAIRE', compte) %}
\t\t\t<a class=\"btn btn-blue\" href=\"{{ path('partenaires_export') }}\">
\t\t\t\t<i class=\"fa fa-download\"></i>
\t\t\t</a>
\t\t{% endif %}
\t\t
\t\t{# <a href=\"{{ path('compte_importer') }}\" class=\"btn btn-float text-default btn-blue\">
\t\t\t<i class=\"fa fa-upload\"></i>
\t\t</a> #}

\t\t{% if is_granted('CREATION_DE_PARTENAIRE', compte) %}
\t\t\t<a class=\"btn btn-blue\" href=\"{{ path('part_new',{id : 4 }) }}\"><i class=\"fa fa-plus\"></i></a>
\t\t{% endif %}
\t</div>
</li>

{% endblock %}
{% block navbar_left %}
<li class=\"nav-item nav-item-secteur\">
\t\t<div class=\"dropdown\">
\t\t\t<button class=\"btn btn-blue dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
\t\t\t\taria-haspopup=\"true\" aria-expanded=\"false\">
\t\t\t\t<span
\t\t\t\t\tstyle=\"border-bottom: 3px solid {{ secteur_active ? secteur_active.color : 'white' }}\">{{ secteur_active ? secteur_active.nom : 'Secteurs' }}</span>
\t\t\t</button>
\t\t\t<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
\t\t\t\t{% if secteur_active %}
\t\t\t\t<a class=\"dropdown-item list-secteurs\" href=\"#\" data-secteur=\"\">Secteurs</a>
\t\t\t\t{% endif %}

\t\t\t\t{% for secteur in secteurs %}

\t\t\t\t{% if secteur_active and secteur_active.id == secteur.id %}
\t\t\t\t<a class=\"dropdown-item d-none list-secteurs\" data-secteur=\"{{ secteur.id }}\"
\t\t\t\t\thref=\"#\">{{ secteur.nom }}</a>
\t\t\t\t{% else %}
\t\t\t\t<a class=\"dropdown-item list-secteurs\" data-secteur=\"{{ secteur.id }}\" href=\"#\">{{ secteur.nom }}</a>
\t\t\t\t{% endif %}
\t\t\t\t{% endfor %}
\t\t\t</div>
\t\t</div>
\t</li>
{% endblock %}
{% block body %}
<div class=\"row main\">
\t<div class=\"col-md-1  wrape-filter-project\">
\t\t<div class=\"filter-project\">
\t\t\t<a class=\"btn-filtre\">
\t\t\t\t<img class=\"img-filtre\" src=\"{{ asset('images/icons/filter-project.svg') }}\" alt=\"\">
\t\t\t</a>
\t\t\t<div class=\"sidebare-filter \">
\t\t\t\t{{ form_start(form,{'attr':{'id':'form_filtre'}}) }}
\t\t\t\t\t{{ form_widget(form) }}
\t\t\t\t\t<button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
\t\t\t\t\t{{ form_end(form) }}
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"col-lg-11 main-projects\">
\t\t<div class=\"row wrapper\">
\t\t\t<div class=\"col-lg-3 wrape-list-project\">
\t\t\t\t<div class=\"items-container-header\">
\t\t\t\t\t<h3>Partenaires ({{ comptes|length }})</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"scroll_container_project\">
\t\t\t\t\t<div class=\"scroll_content_project parent-ajax\">
\t\t\t\t\t\t<ul id=\"list-compte\">
\t\t\t\t\t\t\t{% for compte in comptes %}
\t\t\t\t\t\t\t<li  class=\"list-compte scroll-btn\" data-id=\"{{ compte.id }}\"
\t\t\t\t\t\t\t\tdata-source=\"{{ path('compte_show', {'id': compte.id }) }}\">

\t\t\t\t\t\t\t\t<div class=\"content-list-comptes\">
\t\t\t\t\t\t\t\t\t<div class=\"content content_pro\">
\t\t\t\t\t\t\t\t\t\t<span class=\"item-logo\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset(\"uploads/\"~ (compte.logo ? compte.logo.filename: 'logo_default.png')) }}\"
\t\t\t\t\t\t\t\t\t\t\t\talt=\"\" class=\"img-fluid\">
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"item-title\">
\t\t\t\t\t\t\t\t\t\t\t\t{{ compte.nomCompte }}
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t <span class=\"item-date\">
                                            {{ compte.dateCreation ? compte.dateCreation|date('d/m/Y'):'' }}
                                        </span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-9  body-container\">
\t\t\t\t{# <div class=\"container\">
\t\t\t\t\t\t<div class=\"item-details-empty\">
\t\t\t\t\t\t\t<img src=\"{{ asset('images/dashboard.png') }}\" class=\"img-fluid\">
\t\t\t\t\t\t\t<h3>Aucun projet trouvé</h3>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div> #}
\t\t\t\t<div id=\"item-details-wrapper\" style=\"margin-left: 15px;\">
\t\t\t\t\t<div class=\"item-details-empty\">
\t\t\t\t\t\t<img src=\"{{ asset('images/dashboard.png') }}\" class=\"img-fluid\">
\t\t\t\t\t\t<h3>Merci de sélectionner un partenaire</h3>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div> {#  End main-projects #}
</div> {#  End Main Row #}

\t<button class=\"scroltop\">
\t<i class=\"fa fa-angle-double-up\"></i>
\t</button>
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


{% endblock %}
", "compte/indexparte.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/compte/indexparte.html.twig");
    }
}
