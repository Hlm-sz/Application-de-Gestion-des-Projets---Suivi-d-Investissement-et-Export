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

/* event/index.html.twig */
class __TwigTemplate_e66bddcba1411a5bfebf92ec0aa78989706be8af2ed97a7c1589325e7712c909 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "event/index.html.twig", 1);
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
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("event.Events"), "html", null, true);
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
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("events_index");
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
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("event.Events")), "html", null, true);
        echo "
\t</div>
</a>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 19
    public function block_navbar_right($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_right"));

        // line 20
        echo "<li class=\"nav-item\">
\t";
        // line 21
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("CREATION_DE_EVENT", (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 21, $this->source); })()))) {
            // line 22
            echo "\t\t<a href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("events_new");
            echo "\" class=\"btn btn-float text-default btn-blue\"><i class=\"fa fa-plus\"></i></a>
\t";
        }
        // line 24
        echo "\t";
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("EXTRACTION_EVENTS", (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 24, $this->source); })()))) {
            // line 25
            echo "\t\t<a class=\"btn btn-blue\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("events_export");
            echo "\"><i class=\"fa fa-download\"></i></a>
\t";
        }
        // line 26
        echo "\t\t
</li>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 29
    public function block_navbar_left($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        // line 30
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 32
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 33
        echo "
<div class=\"row main\">
\t<div class=\"col-md-1  wrape-filter-project\">
\t\t<div class=\"filter-project\">
\t\t\t<a class=\"btn-filtre\">
\t\t\t\t<img class=\"img-filtre\" src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/filter-project.svg"), "html", null, true);
        echo "\" alt=\"\">
\t\t\t</a>
\t\t\t<div class=\"sidebare-filter \">
\t\t\t\t";
        // line 41
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), 'form_start', ["action" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_filtre"), "method" => "GET", "attr" => ["id" => "form_filtre"]]);
        echo "
\t\t\t\t\t";
        // line 42
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 42, $this->source); })()), 'widget');
        echo "
\t\t\t\t\t<button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
\t\t\t\t\t";
        // line 44
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 44, $this->source); })()), 'form_end');
        echo "
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"col-lg-11 main-projects\">
\t\t<div class=\"row wrapper\">
\t\t\t<div class=\"col-lg-3 wrape-list-project\">
\t\t\t\t<div class=\"items-container-header\">
\t\t\t\t\t<h3>Events (";
        // line 52
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 52, $this->source); })())), "html", null, true);
        echo ")</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"scroll_container_project\">
\t\t\t\t\t<div class=\"scroll_content_project parent-ajax\">
\t\t\t\t\t\t<ul id=\"list-project \">
\t\t\t\t\t\t\t";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 57, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 58
            echo "\t\t\t\t\t\t\t<li class=\"list-contacts scroll-btn\" data-id=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 58), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\tdata-source=\"";
            // line 59
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_show", ["id" => twig_get_attribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 59)]), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t\t<div class=\"content-list-comptes\">
\t\t\t\t\t\t\t\t\t<div class=\"content content_pro\">
\t\t\t\t\t\t\t\t\t\t";
            // line 65
            echo "\t\t\t\t\t\t\t\t\t\t<span class=\"item-logo\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"name\">";
            // line 66
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, $context["event"], "nom", [], "any", false, false, false, 66)), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"item-title \">
\t\t\t\t\t\t\t\t\t\t\t";
            // line 69
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, twig_get_attribute($this->env, $this->source, $context["event"], "nom", [], "any", false, false, false, 69)), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["event"], "mois", [], "any", false, false, false, 69), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["event"], "annee", [], "any", false, false, false, 69), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t <span class=\"item-date\">
                                            ";
            // line 72
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["event"], "createdAt", [], "any", false, false, false, 72), "d/m/Y"), "html", null, true);
            echo "
                                        </span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t";
            // line 79
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo "\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-9  body-container\">
\t\t\t\t";
        // line 93
        echo "\t\t\t\t<div id=\"item-details-wrapper\" style=\"margin-left: 15px;\">
\t\t\t\t\t<div class=\"item-details-empty\">
\t\t\t\t\t\t<img src=\"";
        // line 95
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/dashboard.png"), "html", null, true);
        echo "\" class=\"img-fluid\">
\t\t\t\t\t\t<h3>Merci de sélectionner un évènement</h3>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div> ";
        // line 102
        echo "</div> ";
        // line 103
        echo "<button class=\"scroltop\" >
\t<i class=\"fa fa-angle-double-up\"></i>
\t</button>

<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js\"></script>
<script src=\"";
        // line 108
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.nameBadges.js"), "html", null, true);
        echo "\"></script>
<script>
\t\$('.name').nameBadge({

\t\t// boder options
\t\tborder: {
\t\t\tcolor: '#ddd',
\t\t\twidth: 1
\t\t},

\t\t// an array of background colors.
\t\tcolors: ['#c5c5c5'],

\t\t// text color
\t\ttext: '#fff',

\t\t// avatar size
\t\tsize: 36,

\t\t// avatar margin
\t\tmargin: 5,

\t\t// disable middle name
\t\tmiddlename: true,

\t\t// force uppercase
\t\tuppercase: false

\t});
</script>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "event/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  312 => 108,  305 => 103,  303 => 102,  294 => 95,  290 => 93,  283 => 82,  275 => 79,  269 => 72,  259 => 69,  253 => 66,  250 => 65,  244 => 59,  239 => 58,  235 => 57,  227 => 52,  216 => 44,  211 => 42,  207 => 41,  201 => 38,  194 => 33,  184 => 32,  173 => 30,  163 => 29,  151 => 26,  145 => 25,  142 => 24,  136 => 22,  134 => 21,  131 => 20,  121 => 19,  107 => 14,  99 => 9,  94 => 8,  84 => 7,  72 => 4,  62 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}
{{'event.Events'| trans}}
{% endblock %}

{% block sous_title %}
<a class=\"navbar-brand\" href=\"{{ path('events_index') }}\">
\t<img src=\"{{ asset('images/amdie.png') }}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\talt=\"logo\">
\t\t<div class=\"SousTitre\">
\t\t<strong>AMDIE</strong>
\t|
\t{{ 'event.Events'| trans | upper }}
\t</div>
</a>
{% endblock %}

{% block navbar_right %}
<li class=\"nav-item\">
\t{% if is_granted('CREATION_DE_EVENT', event) %}
\t\t<a href=\"{{ path('events_new') }}\" class=\"btn btn-float text-default btn-blue\"><i class=\"fa fa-plus\"></i></a>
\t{% endif %}
\t{% if is_granted('EXTRACTION_EVENTS', event) %}
\t\t<a class=\"btn btn-blue\" href=\"{{ path('events_export') }}\"><i class=\"fa fa-download\"></i></a>
\t{% endif %}\t\t
</li>
{% endblock %}
{% block navbar_left %}

{% endblock %}
{% block body %}

<div class=\"row main\">
\t<div class=\"col-md-1  wrape-filter-project\">
\t\t<div class=\"filter-project\">
\t\t\t<a class=\"btn-filtre\">
\t\t\t\t<img class=\"img-filtre\" src=\"{{ asset('images/icons/filter-project.svg') }}\" alt=\"\">
\t\t\t</a>
\t\t\t<div class=\"sidebare-filter \">
\t\t\t\t{{ form_start(form,{'action': path('event_filtre'), 'method': 'GET','attr':{'id':'form_filtre'}}) }}
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
\t\t\t\t\t<h3>Events ({{ events|length }})</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"scroll_container_project\">
\t\t\t\t\t<div class=\"scroll_content_project parent-ajax\">
\t\t\t\t\t\t<ul id=\"list-project \">
\t\t\t\t\t\t\t{% for event in events %}
\t\t\t\t\t\t\t<li class=\"list-contacts scroll-btn\" data-id=\"{{ event.id }}\"
\t\t\t\t\t\t\t\tdata-source=\"{{ path('event_show', {'id': event.id }) }}\">
\t\t\t\t\t\t\t\t<div class=\"content-list-comptes\">
\t\t\t\t\t\t\t\t\t<div class=\"content content_pro\">
\t\t\t\t\t\t\t\t\t\t{# <span class=\"item-logo\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset(\"uploads/\"~ (project.compte.logo ? project.compte.logo.filename: 'logo_default.png')) }}\" alt=\"\" class=\"img-fluid\">
\t\t\t\t\t\t\t\t\t\t</span> #}
\t\t\t\t\t\t\t\t\t\t<span class=\"item-logo\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"name\">{{ event.nom|upper }}</div>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"item-title \">
\t\t\t\t\t\t\t\t\t\t\t{{ event.nom|capitalize }} {{ event.mois }} {{ event.annee }}
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t <span class=\"item-date\">
                                            {{  event.createdAt|date('d/m/Y') }}
                                        </span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t{# <div class=\"d-flex justify-content-between align-items-center\">
\t\t\t\t\t\t\t\t\t\t<span class=\"item-options\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"item-date\">{{ project.dateCreation ? project.dateCreation|date('d/m/Y'):'' }}</span>
\t\t\t\t\t\t\t\t\t</div> #}
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
\t\t\t\t\t\t<h3>Merci de sélectionner un évènement</h3>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div> {#  End main-projects #}
</div> {#  End Main Row #}
<button class=\"scroltop\" >
\t<i class=\"fa fa-angle-double-up\"></i>
\t</button>

<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js\"></script>
<script src=\"{{ asset('js/jquery.nameBadges.js') }}\"></script>
<script>
\t\$('.name').nameBadge({

\t\t// boder options
\t\tborder: {
\t\t\tcolor: '#ddd',
\t\t\twidth: 1
\t\t},

\t\t// an array of background colors.
\t\tcolors: ['#c5c5c5'],

\t\t// text color
\t\ttext: '#fff',

\t\t// avatar size
\t\tsize: 36,

\t\t// avatar margin
\t\tmargin: 5,

\t\t// disable middle name
\t\tmiddlename: true,

\t\t// force uppercase
\t\tuppercase: false

\t});
</script>

{% endblock %}
", "event/index.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/event/index.html.twig");
    }
}
