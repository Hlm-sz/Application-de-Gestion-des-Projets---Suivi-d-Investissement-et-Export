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

/* event/details.html.twig */
class __TwigTemplate_698dff95336092fb92a35c9300d8eb0dbadb49bdc016dece41718b438b57b337 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/details.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/details.html.twig"));

        // line 1
        echo "<div class=\"item-details\">
    <div class=\"item-details-header\">
        <div class=\"d-flex align-items-center\">
            <span class=\"item-logo\">
                <div class=\"eventname\">";
        // line 5
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 5, $this->source); })()), "nom", [], "any", false, false, false, 5)), "html", null, true);
        echo "</div>
            </span>
            <div class=\"item-title align-items-center\">
                <span> ";
        // line 8
        echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 8, $this->source); })()), "nom", [], "any", false, false, false, 8)), "html", null, true);
        echo " </span> <span> &nbsp; /";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 8, $this->source); })()), "annee", [], "any", false, false, false, 8), "html", null, true);
        echo "</span>
            </div>
            <div class=\"wrape-open-project\">
                <div class=\"item-details-header open-project wrap-btn-open-project\">
                    <div class=\" align-items-center pull-right\">
                        <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("events_detail", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 13, $this->source); })()), "id", [], "any", false, false, false, 13)]), "html", null, true);
        echo "\"
                            class=\"btn btn-blue open-btn-blue btn-sm\">Ouvrir event</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=\"item-details-body \">
        <div class=\"container-fluid item-details-header-body item-contact-header\">
            <div class=\"row\">
                <div class=\"col-sm\">
                    <ul class=\"nav nav-tabs cs-nav-tabs\" role=\"tablist\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link active\" data-toggle=\"tab\" href=\"#item-details-project\" role=\"tab\"
                                aria-selected=\"true\">Informations primaires</a>
                        </li>
                    </ul>
                </div>
                <div class=\"col-sm\">
                    <div class=\"wrape-type-project\">
                    </div>
                </div>
                <div class=\"col-sm \">
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-12 content-info\">
                <div class=\"item-details\">
                    <div class=\"item-details-body container-fluid\">
                        ";
        // line 43
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 43, $this->source); })()), 'form_start', ["attr" => ["id" => "form_event"]]);
        echo "
                        <div class=\"row align-items-start mb-4\">
                            <div class=\"col-lg-6\">

                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block required\" for=\"event_nom\">Nom de
                                        l’événement</label>
                                    ";
        // line 50
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 50, $this->source); })()), "nom", [], "any", false, false, false, 50), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "

                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block required\" for=\"event_mois\">Mois</label>

                                    ";
        // line 58
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), "mois", [], "any", false, false, false, 58), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block required\" for=\"event_annee\">Année</label>

                                    ";
        // line 65
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 65, $this->source); })()), "annee", [], "any", false, false, false, 65), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block  required\" for=\"event_pays\">Pays</label>

                                    ";
        // line 72
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 72, $this->source); })()), "pays", [], "any", false, false, false, 72), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4  required\" for=\"event_secteur\">
                                    <label class=\"cs-label d-block\">Secteur</label>

                                    ";
        // line 79
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 79, $this->source); })()), "secteur", [], "any", false, false, false, 79), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4  required\" for=\"event_formatParticipation\">
                                    <label class=\"cs-label d-block\">Format de participation</label>

                                    ";
        // line 86
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 86, $this->source); })()), "formatParticipation", [], "any", false, false, false, 86), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4  required\" for=\"event_Organisateur\">
                                    <label class=\"cs-label d-block\">Organisateur</label>

                                    ";
        // line 93
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 93, $this->source); })()), "Organisateur", [], "any", false, false, false, 93), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "
                                </div>
                            </div>
                            <div class=\"col-lg-6\">
                                <div class=\"form-group mb-4  required\" for=\"event_partenaires\">
                                    <label class=\"cs-label d-block\">Partenaires</label>

                                    ";
        // line 100
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 100, $this->source); })()), "partenaires", [], "any", false, false, false, 100), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "
                                </div>
                            </div>
                            <div class=\"col-lg-6\">
                                <div class=\"form-group mb-4  required\" for=\"event_typeEvenement\">
                                    <label class=\"cs-label d-block\">Type d’événement</label>
                                    <div class=\"radio-holder\">
                                        ";
        // line 107
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 107, $this->source); })()), "typeEvenement", [], "any", false, false, false, 107), 'widget', ["attr" => ["disabled" => "disabled"]]);
        echo "
                                    </div>

                                </div>
                            </div>
                            <div class=\"col-lg-12\">
                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block\">Description</label>

                                    ";
        // line 116
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 116, $this->source); })()), "description", [], "any", false, false, false, 116), 'widget', ["attr" => ["rows" => "10"], "attr" => ["disabled" => "disabled"]]);
        echo "

                                </div>
                            </div>
                        </div>
                        <div style=\"display: none;\">
                            ";
        // line 122
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 122, $this->source); })()), "comptes", [], "any", false, false, false, 122), 'widget');
        echo "
                        </div>
                        ";
        // line 124
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 124, $this->source); })()), 'form_end');
        echo "

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    \$(\"#projet_data_Confidentiel,#projet_data_Prioritaire\").css(\"display\", \"none\");
</script>
<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js\"></script>
<script src=\"";
        // line 136
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.nameBadges.js"), "html", null, true);
        echo "\"></script>
<script>
    \$('.eventname').nameBadge({
        // boder options
        border: {
            color: '#ddd',
            width: 1
        },
        // an array of background colors.
        colors: ['#c5c5c5'],
        // text color
        text: '#fff',
        // avatar size
        size: 45,
        // avatar margin
        margin: 5,
        // disable middle name
        middlename: true,
        // force uppercase
        uppercase: false

    });
</script>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "event/details.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  230 => 136,  215 => 124,  210 => 122,  201 => 116,  189 => 107,  179 => 100,  169 => 93,  159 => 86,  149 => 79,  139 => 72,  129 => 65,  119 => 58,  108 => 50,  98 => 43,  65 => 13,  55 => 8,  49 => 5,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"item-details\">
    <div class=\"item-details-header\">
        <div class=\"d-flex align-items-center\">
            <span class=\"item-logo\">
                <div class=\"eventname\">{{ event.nom|upper}}</div>
            </span>
            <div class=\"item-title align-items-center\">
                <span> {{ event.nom|capitalize }} </span> <span> &nbsp; /{{ event.annee }}</span>
            </div>
            <div class=\"wrape-open-project\">
                <div class=\"item-details-header open-project wrap-btn-open-project\">
                    <div class=\" align-items-center pull-right\">
                        <a href=\"{{ path('events_detail',{'id': event.id}) }}\"
                            class=\"btn btn-blue open-btn-blue btn-sm\">Ouvrir event</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=\"item-details-body \">
        <div class=\"container-fluid item-details-header-body item-contact-header\">
            <div class=\"row\">
                <div class=\"col-sm\">
                    <ul class=\"nav nav-tabs cs-nav-tabs\" role=\"tablist\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link active\" data-toggle=\"tab\" href=\"#item-details-project\" role=\"tab\"
                                aria-selected=\"true\">Informations primaires</a>
                        </li>
                    </ul>
                </div>
                <div class=\"col-sm\">
                    <div class=\"wrape-type-project\">
                    </div>
                </div>
                <div class=\"col-sm \">
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-12 content-info\">
                <div class=\"item-details\">
                    <div class=\"item-details-body container-fluid\">
                        {{ form_start(form, {'attr': {'id': 'form_event'}}) }}
                        <div class=\"row align-items-start mb-4\">
                            <div class=\"col-lg-6\">

                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block required\" for=\"event_nom\">Nom de
                                        l’événement</label>
                                    {{ form_widget(form.nom,{'attr':{'disabled':'disabled'}}) }}

                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block required\" for=\"event_mois\">Mois</label>

                                    {{ form_widget(form.mois,{'attr':{'disabled':'disabled'}}) }}
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block required\" for=\"event_annee\">Année</label>

                                    {{ form_widget(form.annee,{'attr':{'disabled':'disabled'}}) }}
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block  required\" for=\"event_pays\">Pays</label>

                                    {{ form_widget(form.pays,{'attr':{'disabled':'disabled'}}) }}
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4  required\" for=\"event_secteur\">
                                    <label class=\"cs-label d-block\">Secteur</label>

                                    {{ form_widget(form.secteur,{'attr':{'disabled':'disabled'}}) }}
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4  required\" for=\"event_formatParticipation\">
                                    <label class=\"cs-label d-block\">Format de participation</label>

                                    {{ form_widget(form.formatParticipation,{'attr':{'disabled':'disabled'}}) }}
                                </div>
                            </div>
                            <div class=\"col-lg-3\">
                                <div class=\"form-group mb-4  required\" for=\"event_Organisateur\">
                                    <label class=\"cs-label d-block\">Organisateur</label>

                                    {{ form_widget(form.Organisateur,{'attr':{'disabled':'disabled'}}) }}
                                </div>
                            </div>
                            <div class=\"col-lg-6\">
                                <div class=\"form-group mb-4  required\" for=\"event_partenaires\">
                                    <label class=\"cs-label d-block\">Partenaires</label>

                                    {{ form_widget(form.partenaires,{'attr':{'disabled':'disabled'}}) }}
                                </div>
                            </div>
                            <div class=\"col-lg-6\">
                                <div class=\"form-group mb-4  required\" for=\"event_typeEvenement\">
                                    <label class=\"cs-label d-block\">Type d’événement</label>
                                    <div class=\"radio-holder\">
                                        {{ form_widget(form.typeEvenement,{'attr':{'disabled':'disabled'}}) }}
                                    </div>

                                </div>
                            </div>
                            <div class=\"col-lg-12\">
                                <div class=\"form-group mb-4\">
                                    <label class=\"cs-label d-block\">Description</label>

                                    {{ form_widget(form.description,{attr: {rows: '10'},'attr':{'disabled':'disabled'} }) }}

                                </div>
                            </div>
                        </div>
                        <div style=\"display: none;\">
                            {{ form_widget(form.comptes) }}
                        </div>
                        {{ form_end(form) }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    \$(\"#projet_data_Confidentiel,#projet_data_Prioritaire\").css(\"display\", \"none\");
</script>
<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js\"></script>
<script src=\"{{ asset('js/jquery.nameBadges.js') }}\"></script>
<script>
    \$('.eventname').nameBadge({
        // boder options
        border: {
            color: '#ddd',
            width: 1
        },
        // an array of background colors.
        colors: ['#c5c5c5'],
        // text color
        text: '#fff',
        // avatar size
        size: 45,
        // avatar margin
        margin: 5,
        // disable middle name
        middlename: true,
        // force uppercase
        uppercase: false

    });
</script>", "event/details.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/event/details.html.twig");
    }
}
