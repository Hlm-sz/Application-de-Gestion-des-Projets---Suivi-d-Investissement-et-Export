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

/* projets/index.html.twig */
class __TwigTemplate_84a70efafd1b644d83628d688258f7ceae272172a34d9b2a597506bcdb5df193 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "projets/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "projets/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "projets/index.html.twig", 1);
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
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_index");
        echo "\">
    <img src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/amdie.png"), "html", null, true);
        echo "\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"logo\">
    <div class=\"SousTitre\">
        <strong>AMDIE</strong>
        |
        ";
        // line 13
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("projet.titre_projet")), "html", null, true);
        echo "
    </div>
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
            echo "<form class=\"form-inline\" action=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_index", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 19, $this->source); })()), "id", [], "any", false, false, false, 19)]), "html", null, true);
            echo "\" method=\"get\">
    ";
        } else {
            // line 21
            echo "    <form class=\"form-inline\" action=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_index");
            echo "\" method=\"get\">
        ";
        }
        // line 23
        echo "        ";
        // line 24
        echo "    </form>
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 26
    public function block_navbar_right($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        // line 27
        echo "    ";
        // line 28
        echo "    <li class=\"nav-item\">
        <div class=\"dropdown\">
            <button class=\"btn btn-blue \" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
                aria-haspopup=\"true\" aria-expanded=\"false\">
                <i class=\"fa fa-plus\"></i>
            </button>
            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
            ";
        // line 35
        if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 35, $this->source); })()), "user", [], "any", false, false, false, 35), "groupe", [], "any", false, false, false, 35), "nom", [], "any", false, false, false, 35), "Directeur Secteur Invest"))) {
            // line 36
            echo "                <a class=\"dropdown-item\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 1]);
            echo "\">Projet investissement</a>
            ";
        } elseif ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 37
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 37, $this->source); })()), "user", [], "any", false, false, false, 37), "groupe", [], "any", false, false, false, 37), "nom", [], "any", false, false, false, 37), "Directeur Secteur Export et sourcing"))) {
            // line 38
            echo "            <a class=\"dropdown-item\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 2]);
            echo "\">Projet sourcing</a>
\t\t\t    <a class=\"dropdown-item\" href=\"";
            // line 39
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 3]);
            echo "\">Projet export</a>
            ";
        } else {
            // line 41
            echo "                <a class=\"dropdown-item\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 1]);
            echo "\">Projet investissement</a>
\t\t\t    <a class=\"dropdown-item\" href=\"";
            // line 42
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 2]);
            echo "\">Projet sourcing</a>
\t\t\t    <a class=\"dropdown-item\" href=\"";
            // line 43
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_new", ["id" => 3]);
            echo "\">Projet export</a>
            ";
        }
        // line 45
        echo "            </div>
        </div>
    </li>
    ";
        // line 50
        echo "    ";
        // line 54
        echo "    ";
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("EXTRACTIONS_PROJETS", (isset($context["projet"]) || array_key_exists("projet", $context) ? $context["projet"] : (function () { throw new RuntimeError('Variable "projet" does not exist.', 54, $this->source); })()))) {
            // line 55
            echo "    ";
            // line 58
            echo "    <a class=\"btn btn-blue\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_export");
            echo "\">
\t\t\t<i class=\"fa fa-download\"></i>
\t\t</a>
    ";
        }
        // line 62
        echo "
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 64
    public function block_navbar_left($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        // line 65
        echo "    <li class=\"nav-item nav-item-secteur\">
        <div class=\"dropdown\">
            <button class=\"btn btn-blue dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
                aria-haspopup=\"true\" aria-expanded=\"false\">
                <span
                    style=\"border-bottom: 3px solid ";
        // line 70
        (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 70, $this->source); })())) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 70, $this->source); })()), "color", [], "any", false, false, false, 70), "html", null, true))) : (print ("white")));
        echo "\">";
        (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 70, $this->source); })())) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 70, $this->source); })()), "nom", [], "any", false, false, false, 70), "html", null, true))) : (print ("Secteurs")));
        echo "</span>
            </button>
            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                ";
        // line 73
        if ((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 73, $this->source); })())) {
            // line 74
            echo "                <a class=\"dropdown-item list-secteurs\" href=\"#\" data-secteur=\"\">Secteurs</a>
                ";
        }
        // line 76
        echo "
                ";
        // line 77
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["secteurs"]) || array_key_exists("secteurs", $context) ? $context["secteurs"] : (function () { throw new RuntimeError('Variable "secteurs" does not exist.', 77, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["secteur"]) {
            // line 78
            echo "
                ";
            // line 79
            if (((isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 79, $this->source); })()) && (0 === twig_compare(twig_get_attribute($this->env, $this->source, (isset($context["secteur_active"]) || array_key_exists("secteur_active", $context) ? $context["secteur_active"] : (function () { throw new RuntimeError('Variable "secteur_active" does not exist.', 79, $this->source); })()), "id", [], "any", false, false, false, 79), twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 79))))) {
                // line 80
                echo "                <a class=\"dropdown-item d-none list-secteurs\" data-secteur=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 80), "html", null, true);
                echo "\"
                    href=\"#\">";
                // line 81
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "nom", [], "any", false, false, false, 81), "html", null, true);
                echo "</a>
                ";
            } else {
                // line 83
                echo "                <a class=\"dropdown-item list-secteurs\" data-secteur=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "id", [], "any", false, false, false, 83), "html", null, true);
                echo "\" href=\"#\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "nom", [], "any", false, false, false, 83), "html", null, true);
                echo "</a>
                ";
            }
            // line 85
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['secteur'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "            </div>
        </div>
    </li>
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 90
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 91
        echo "
    <div class=\"row main\">
        <div class=\"col-md-1  wrape-filter-project\">
            <div class=\"filter-project\">
                <a class=\"btn-filtre\" onclick=\"document.querySelector('.main-projects').style.transition='all .3s'; document.querySelector('.main-projects').style.transform == 'translateX(0px)' || !document.querySelector('.main-projects').style.transform ? (document.querySelector('.main-projects').style.transform = 'translateX(310px)') : (document.querySelector('.main-projects').style.transform = 'translateX(0)')\">
                    <img class=\"img-filtre\" src=\"";
        // line 96
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/filter-project.svg"), "html", null, true);
        echo "\" alt=\"\"></a>
                <div class=\"sidebare-filter \" style=\"height: auto;\">
                    ";
        // line 98
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 98, $this->source); })()), 'form_start', ["attr" => ["id" => "form_filtre"]]);
        echo "
                    ";
        // line 99
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 99, $this->source); })()), 'widget');
        echo "
                    <button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
                    ";
        // line 101
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 101, $this->source); })()), 'form_end');
        echo "
                </div>
            </div>
        </div>
        <div class=\"col-lg-11 main-projects\">
            <div class=\"row wrapper\">
                <div class=\"col-lg-3 wrape-list-project\">
                    <div class=\"items-container-header\">
                        <h3>Projets (";
        // line 109
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["projects"]) || array_key_exists("projects", $context) ? $context["projects"] : (function () { throw new RuntimeError('Variable "projects" does not exist.', 109, $this->source); })())), "html", null, true);
        echo ")</h3>
                    </div>
                    <div class=\"scroll_container_project\">
                        <div class=\"scroll_content_project parent-ajax\">
                            <ul id=\"list-project \">
                                ";
        // line 114
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["projects"]) || array_key_exists("projects", $context) ? $context["projects"] : (function () { throw new RuntimeError('Variable "projects" does not exist.', 114, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
            // line 115
            echo "
                                <li class=\"list-project scroll-btn button1\" data-id=\"";
            // line 116
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "id", [], "any", false, false, false, 116), "html", null, true);
            echo "\"
                                    data-source=\"";
            // line 117
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_show", ["id" => twig_get_attribute($this->env, $this->source, $context["project"], "id", [], "any", false, false, false, 117)]), "html", null, true);
            echo "\">
                                    ";
            // line 118
            if (twig_get_attribute($this->env, $this->source, $context["project"], "confidentiel", [], "any", false, false, false, 118)) {
                // line 119
                echo "                                    <span class=\"lock\" alt=\"Confidentiel\" title=\"Confidentiel\">
                                        <img src=\"";
                // line 120
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/lock.svg"), "html", null, true);
                echo "\" alt=\"\"></span>
                                    ";
            }
            // line 122
            echo "                                    ";
            if (twig_get_attribute($this->env, $this->source, $context["project"], "prioritaire", [], "any", false, false, false, 122)) {
                // line 123
                echo "                                    <span class=\"trace\" alt=\"Prioritaire\" title=\"Prioritaire\">
                                        <img src=\"";
                // line 124
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/Trace.svg"), "html", null, true);
                echo "\" alt=\"\"></span>
                                    ";
            }
            // line 126
            echo "
                                    <div class=\"content-list-projects\">
                                        <div class=\"content content_pro\">
                                            <span class=\"item-logo\">
                                                <img src=\"";
            // line 130
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["project"], "compte", [], "any", false, false, false, 130), "logo", [], "any", false, false, false, 130)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["project"], "compte", [], "any", false, false, false, 130), "logo", [], "any", false, false, false, 130), "filename", [], "any", false, false, false, 130)) : ("logo_default.png")))), "html", null, true);
            echo "\"
                                                    alt=\"\" class=\"img-fluid\"></span>
                                            <span class=\"item-title\">
                                                ";
            // line 133
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "titre", [], "any", false, false, false, 133), "html", null, true);
            echo "
                                            </span>
                                            <span class=\"item-date\">
                                                ";
            // line 136
            ((twig_get_attribute($this->env, $this->source, $context["project"], "dateCreation", [], "any", false, false, false, 136)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "dateCreation", [], "any", false, false, false, 136), "d/m/Y"), "html", null, true))) : (print ("")));
            echo "
                                            </span>
                                        </div>

                                    </div>
                                </li>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 143
        echo "                            </ul>
                        </div>
                    </div>
                </div>
                <div class=\"col-lg-9  body-container\">
                    ";
        // line 154
        echo "                    <div id=\"item-details-wrapper\" style=\"margin-left: 15px;\">
                        <div class=\"item-details-empty\">
                            <img src=\"";
        // line 156
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/dashboard.png"), "html", null, true);
        echo "\" class=\"img-fluid\">
                            <h3>Merci de sélectionner un projet</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ";
        // line 164
        echo "    </div>
    ";
        // line 166
        echo "    <button class=\"scroltop\">
        <i class=\"fa fa-angle-double-up\"></i>
    </button>
    <script>
        \$(document).ready(function () {
            \$(document).on('click', '.list-secteurs', function (e) {
                e.preventDefault();
                var secteur = \$(this).data('secteur');
                \$('#secteur').val(secteur);
                // console.log(source);
                \$(\"#telecharger\").remove();
                \$('#form_filtre').submit();
            })
            \$(document).on('click', '.download', function (e) {
                e.preventDefault();
                \$('#form_filtre').append(
                    '<input type=\"hidden\" id=\"telecharger\" name=\"telecharger\" value=\"1\">');
                \$('#form_filtre').submit();
            })
            \$(document).on('click', '.tri', function (e) {
                e.preventDefault();
                var tri = \$(this).data('tri');
                \$('#tri').val(tri);
                \$(\"#telecharger\").remove();
                // console.log(tri);
                \$('#form_filtre').submit();
            })
            \$(\"#filtre\").click(function (e) {
                e.preventDefault();
                \$(\"#telecharger\").remove();
                changeAutocomplate();
                \$(\"#form_filtre\").submit();

            });

            function changeAutocomplate() {
                if (\$('#compte_filtre').val() == '') { // alert(\$('#compte_filtre').val());
                    \$('#compte').val('');
                }
                if (\$('#user_filtre').val() == '') { // alert(\$('#user_filtre').val());
                    \$('#gerePar').val('');
                }
            }
        })
    </script>
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "projets/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  464 => 166,  461 => 164,  451 => 156,  447 => 154,  440 => 143,  427 => 136,  421 => 133,  415 => 130,  409 => 126,  404 => 124,  401 => 123,  398 => 122,  393 => 120,  390 => 119,  388 => 118,  384 => 117,  380 => 116,  377 => 115,  373 => 114,  365 => 109,  354 => 101,  349 => 99,  345 => 98,  340 => 96,  333 => 91,  323 => 90,  310 => 86,  304 => 85,  296 => 83,  291 => 81,  286 => 80,  284 => 79,  281 => 78,  277 => 77,  274 => 76,  270 => 74,  268 => 73,  260 => 70,  253 => 65,  243 => 64,  232 => 62,  224 => 58,  222 => 55,  219 => 54,  217 => 50,  212 => 45,  207 => 43,  203 => 42,  198 => 41,  193 => 39,  188 => 38,  186 => 37,  181 => 36,  179 => 35,  170 => 28,  168 => 27,  158 => 26,  147 => 24,  145 => 23,  139 => 21,  133 => 19,  131 => 18,  121 => 17,  107 => 13,  100 => 9,  95 => 8,  85 => 7,  73 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}
{{ 'projet.listes_projet'| trans }}
{% endblock %}

{% block sous_title %}
<a class=\"navbar-brand\" href=\"{{ path('projets_index') }}\">
    <img src=\"{{ asset('images/amdie.png') }}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"logo\">
    <div class=\"SousTitre\">
        <strong>AMDIE</strong>
        |
        {{ 'projet.titre_projet'| trans | upper }}
    </div>
</a>
{% endblock %}
{% block header_search %}
{% if secteur_active %}
<form class=\"form-inline\" action=\"{{ path('projets_index',{'id':secteur_active.id}) }}\" method=\"get\">
    {% else %}
    <form class=\"form-inline\" action=\"{{ path('projets_index') }}\" method=\"get\">
        {% endif %}
        {# <input class=\"form-control mr-sm-2\" name=\"search\" type=\"search\" placeholder=\"Chercher\" aria-label=\"Chercher\"> #}
    </form>
    {% endblock %}
    {% block navbar_right %}
    {# {% if is_granted('CREATION_DE_PROJET', projects[0]) %} #}
    <li class=\"nav-item\">
        <div class=\"dropdown\">
            <button class=\"btn btn-blue \" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
                aria-haspopup=\"true\" aria-expanded=\"false\">
                <i class=\"fa fa-plus\"></i>
            </button>
            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
            {% if app.user.groupe.nom == \"Directeur Secteur Invest\" %}
                <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 1 }) }}\">Projet investissement</a>
            {% elseif app.user.groupe.nom == \"Directeur Secteur Export et sourcing\" %}
            <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 2 }) }}\">Projet sourcing</a>
\t\t\t    <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 3 }) }}\">Projet export</a>
            {% else %}
                <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 1 }) }}\">Projet investissement</a>
\t\t\t    <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 2 }) }}\">Projet sourcing</a>
\t\t\t    <a class=\"dropdown-item\" href=\"{{ path('projets_new',{id : 3 }) }}\">Projet export</a>
            {% endif %}
            </div>
        </div>
    </li>
    {# {% endif %}
            {% if is_granted('IMPORTATION_DES_FICHIERS_DE_DONNEES_PROJETS', projects[0]) %} #}
    {# <button class=\"btn btn-blue \" type=\"button\">
            \t\t &nbsp;<i class=\"fa fa-upload\"></i>
            \t</button>
             {% endif %}#}
    {% if is_granted('EXTRACTIONS_PROJETS', projet) %}
    {# <a class=\"btn btn-blue download\" href=\"#\">
        &nbsp;<i class=\"fa fa-download\"></i>
    </a> #}
    <a class=\"btn btn-blue\" href=\"{{ path('projets_export') }}\">
\t\t\t<i class=\"fa fa-download\"></i>
\t\t</a>
    {% endif %}

    {% endblock %}
    {% block navbar_left %}
    <li class=\"nav-item nav-item-secteur\">
        <div class=\"dropdown\">
            <button class=\"btn btn-blue dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\"
                aria-haspopup=\"true\" aria-expanded=\"false\">
                <span
                    style=\"border-bottom: 3px solid {{ secteur_active ? secteur_active.color : 'white' }}\">{{ secteur_active ? secteur_active.nom : 'Secteurs' }}</span>
            </button>
            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                {% if secteur_active %}
                <a class=\"dropdown-item list-secteurs\" href=\"#\" data-secteur=\"\">Secteurs</a>
                {% endif %}

                {% for secteur in secteurs %}

                {% if secteur_active and secteur_active.id == secteur.id %}
                <a class=\"dropdown-item d-none list-secteurs\" data-secteur=\"{{ secteur.id }}\"
                    href=\"#\">{{ secteur.nom }}</a>
                {% else %}
                <a class=\"dropdown-item list-secteurs\" data-secteur=\"{{ secteur.id }}\" href=\"#\">{{ secteur.nom }}</a>
                {% endif %}
                {% endfor %}
            </div>
        </div>
    </li>
    {% endblock %}
    {% block body %}

    <div class=\"row main\">
        <div class=\"col-md-1  wrape-filter-project\">
            <div class=\"filter-project\">
                <a class=\"btn-filtre\" onclick=\"document.querySelector('.main-projects').style.transition='all .3s'; document.querySelector('.main-projects').style.transform == 'translateX(0px)' || !document.querySelector('.main-projects').style.transform ? (document.querySelector('.main-projects').style.transform = 'translateX(310px)') : (document.querySelector('.main-projects').style.transform = 'translateX(0)')\">
                    <img class=\"img-filtre\" src=\"{{ asset('images/icons/filter-project.svg') }}\" alt=\"\"></a>
                <div class=\"sidebare-filter \" style=\"height: auto;\">
                    {{ form_start(form,{'attr':{'id':'form_filtre' }}) }}
                    {{ form_widget(form) }}
                    <button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
                    {{ form_end(form) }}
                </div>
            </div>
        </div>
        <div class=\"col-lg-11 main-projects\">
            <div class=\"row wrapper\">
                <div class=\"col-lg-3 wrape-list-project\">
                    <div class=\"items-container-header\">
                        <h3>Projets ({{ projects|length }})</h3>
                    </div>
                    <div class=\"scroll_container_project\">
                        <div class=\"scroll_content_project parent-ajax\">
                            <ul id=\"list-project \">
                                {% for project in projects %}

                                <li class=\"list-project scroll-btn button1\" data-id=\"{{ project.id }}\"
                                    data-source=\"{{ path('projets_show', {'id': project.id }) }}\">
                                    {% if project.confidentiel %}
                                    <span class=\"lock\" alt=\"Confidentiel\" title=\"Confidentiel\">
                                        <img src=\"{{ asset('images/icons/lock.svg') }}\" alt=\"\"></span>
                                    {% endif %}
                                    {% if project.prioritaire %}
                                    <span class=\"trace\" alt=\"Prioritaire\" title=\"Prioritaire\">
                                        <img src=\"{{ asset('images/icons/Trace.svg') }}\" alt=\"\"></span>
                                    {% endif %}

                                    <div class=\"content-list-projects\">
                                        <div class=\"content content_pro\">
                                            <span class=\"item-logo\">
                                                <img src=\"{{ asset(\"uploads/\"~ (project.compte.logo ? project.compte.logo.filename: 'logo_default.png')) }}\"
                                                    alt=\"\" class=\"img-fluid\"></span>
                                            <span class=\"item-title\">
                                                {{ project.titre }}
                                            </span>
                                            <span class=\"item-date\">
                                                {{ project.dateCreation ? project.dateCreation|date('d/m/Y'):'' }}
                                            </span>
                                        </div>

                                    </div>
                                </li>
                                {% endfor %}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=\"col-lg-9  body-container\">
                    {# <div class=\"container\">
                                            \t\t\t\t\t\t<div class=\"item-details-empty\">
                                            \t\t\t\t\t\t\t<img src=\"{{ asset('images/dashboard.png') }}\" class=\"img-fluid\">
                                            \t\t\t\t\t\t\t<h3>Aucun projet trouvé</h3>
                                            \t\t\t\t\t\t</div>
                                            \t\t\t\t\t</div> #}
                    <div id=\"item-details-wrapper\" style=\"margin-left: 15px;\">
                        <div class=\"item-details-empty\">
                            <img src=\"{{ asset('images/dashboard.png') }}\" class=\"img-fluid\">
                            <h3>Merci de sélectionner un projet</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {#  End main-projects #}
    </div>
    {#  End Main Row #}
    <button class=\"scroltop\">
        <i class=\"fa fa-angle-double-up\"></i>
    </button>
    <script>
        \$(document).ready(function () {
            \$(document).on('click', '.list-secteurs', function (e) {
                e.preventDefault();
                var secteur = \$(this).data('secteur');
                \$('#secteur').val(secteur);
                // console.log(source);
                \$(\"#telecharger\").remove();
                \$('#form_filtre').submit();
            })
            \$(document).on('click', '.download', function (e) {
                e.preventDefault();
                \$('#form_filtre').append(
                    '<input type=\"hidden\" id=\"telecharger\" name=\"telecharger\" value=\"1\">');
                \$('#form_filtre').submit();
            })
            \$(document).on('click', '.tri', function (e) {
                e.preventDefault();
                var tri = \$(this).data('tri');
                \$('#tri').val(tri);
                \$(\"#telecharger\").remove();
                // console.log(tri);
                \$('#form_filtre').submit();
            })
            \$(\"#filtre\").click(function (e) {
                e.preventDefault();
                \$(\"#telecharger\").remove();
                changeAutocomplate();
                \$(\"#form_filtre\").submit();

            });

            function changeAutocomplate() {
                if (\$('#compte_filtre').val() == '') { // alert(\$('#compte_filtre').val());
                    \$('#compte').val('');
                }
                if (\$('#user_filtre').val() == '') { // alert(\$('#user_filtre').val());
                    \$('#gerePar').val('');
                }
            }
        })
    </script>
    {% endblock %}", "projets/index.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/projets/index.html.twig");
    }
}
