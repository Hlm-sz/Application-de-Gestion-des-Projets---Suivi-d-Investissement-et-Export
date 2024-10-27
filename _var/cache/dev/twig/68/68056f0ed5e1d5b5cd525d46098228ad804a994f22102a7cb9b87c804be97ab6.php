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

/* event/third_header/_third_header.html.twig */
class __TwigTemplate_86f66a90593e0e5cb70ce7ce862539aa6de2f97a2ee8cdd30608854affd7fad0 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/third_header/_third_header.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/third_header/_third_header.html.twig"));

        // line 2
        echo "\t<div class=\"third-header col-md-12\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-8\">
\t\t\t\t<ul class=\"etapes steps\">
\t\t\t\t\t
\t\t\t\t\t\t<li>
\t\t\t\t\t\t";
        // line 8
        if (twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 8, $this->source); })()), "isValide", [], "any", false, false, false, 8)) {
            // line 9
            echo "\t\t\t\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_change_activation", ["isactive" => 0, "event" => twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 9, $this->source); })()), "id", [], "any", false, false, false, 9)]), "html", null, true);
            echo "\" class=\"";
            echo (((0 === twig_compare(twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 9, $this->source); })()), "isvalide", [], "any", false, false, false, 9), true))) ? ("active") : (""));
            echo "\">
\t\t\t\t\t\t\t\t<img src=\"";
            // line 10
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/confirm.svg"), "html", null, true);
            echo "\" alt=\"\">
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<label for=\"\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-sort-asc\" aria-hidden=\"true\"></i>
\t\t\t\t\t\t\t\t\t";
            // line 14
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("event.Valide"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t";
        } else {
            // line 17
            echo "\t\t\t\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_change_activation", ["isactive" => 1, "event" => twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 17, $this->source); })()), "id", [], "any", false, false, false, 17)]), "html", null, true);
            echo "\" class=\"";
            echo (((0 === twig_compare(twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 17, $this->source); })()), "isvalide", [], "any", false, false, false, 17), true))) ? ("active") : (""));
            echo "\">
\t\t\t\t\t\t\t\t<img src=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/confirm.svg"), "html", null, true);
            echo "\" alt=\"\">
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<label for=\"\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-sort-asc\" aria-hidden=\"true\"></i>
\t\t\t\t\t\t\t\t\t";
            // line 22
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("event.Valide"), "html", null, true);
            echo "
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t";
        }
        // line 25
        echo "\t\t\t\t\t\t</li>
\t\t\t\t\t<div class=\"last-step pull-right\">
\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<div class=\"col-md-2\">
\t\t\t\t";
        // line 43
        echo "\t\t\t</div>
\t\t\t
\t\t</div>
\t</div>
\t";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "event/third_header/_third_header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 43,  93 => 25,  87 => 22,  80 => 18,  73 => 17,  67 => 14,  60 => 10,  53 => 9,  51 => 8,  43 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# Start header third #}
\t<div class=\"third-header col-md-12\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-8\">
\t\t\t\t<ul class=\"etapes steps\">
\t\t\t\t\t
\t\t\t\t\t\t<li>
\t\t\t\t\t\t{% if event.isValide %}
\t\t\t\t\t\t\t<a href=\"{{ path('event_change_activation',{'isactive':0,'event':event.id}) }}\" class=\"{{ event.isvalide == true ? 'active' : '' }}\">
\t\t\t\t\t\t\t\t<img src=\"{{ asset('images/icons/confirm.svg') }}\" alt=\"\">
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<label for=\"\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-sort-asc\" aria-hidden=\"true\"></i>
\t\t\t\t\t\t\t\t\t{{ 'event.Valide'| trans }}
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t<a href=\"{{ path('event_change_activation',{'isactive':1,'event':event.id}) }}\" class=\"{{ event.isvalide == true ? 'active' : '' }}\">
\t\t\t\t\t\t\t\t<img src=\"{{ asset('images/icons/confirm.svg') }}\" alt=\"\">
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<label for=\"\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-sort-asc\" aria-hidden=\"true\"></i>
\t\t\t\t\t\t\t\t\t{{ 'event.Valide'| trans }}
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t</li>
\t\t\t\t\t<div class=\"last-step pull-right\">
\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<div class=\"col-md-2\">
\t\t\t\t{# <ul class=\"GPAC\" id=\"type-event\">
\t\t\t\t\t<li data-val=\"Investissement\" title=\"Investissement\" class={{ event.typeEvenement != \"Export\" ? \"active\" : \"\" }} >
\t\t\t\t\t    <a  class=\"\" href=\"\">I</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li data-val=\"Export\"  class={{ event.typeEvenement == \"Export\" ? \"active\" : \"\" }}>
\t\t\t\t\t    <a  class=\"\" title=\"Export\" href=\"\">E</a>\t
\t\t\t\t\t</li>
                    
\t\t\t\t\t
\t\t\t\t</ul> #}
\t\t\t</div>
\t\t\t
\t\t</div>
\t</div>
\t{# Enddddd #}
", "event/third_header/_third_header.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/event/third_header/_third_header.html.twig");
    }
}
