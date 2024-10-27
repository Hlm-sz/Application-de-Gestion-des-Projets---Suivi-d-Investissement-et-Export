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

/* event/_form.html.twig */
class __TwigTemplate_154e8f9301dafee61f18304c24ebe4407d12723ea9a6bcdfbfd8c732557de81a extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/_form.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/_form.html.twig"));

        // line 1
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 1, $this->source); })()), 'form_start', ["attr" => ["id" => "form_event"]]);
        echo "
             <div class=\"row align-items-start mb-4\">
                <div class=\"col-lg-6\">
              
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block required\" for=\"event_nom\">Nom de l’événement</label>
                        ";
        // line 7
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 7, $this->source); })()), "nom", [], "any", false, false, false, 7), 'widget');
        echo " 
                        
                    </div>
                </div>
                <div class=\"col-lg-3\">
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block required\" for=\"event_mois\">Mois</label>

                        ";
        // line 15
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 15, $this->source); })()), "mois", [], "any", false, false, false, 15), 'widget');
        echo " 
                    </div>
                </div>
                <div class=\"col-lg-3\">
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block required\" for=\"event_annee\">Année</label>

                        ";
        // line 22
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 22, $this->source); })()), "annee", [], "any", false, false, false, 22), 'widget');
        echo " 
                    </div>
                </div>
                <div class=\"col-lg-4\">
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block  required\" for=\"event_pays\">Pays</label>
                        ";
        // line 28
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "pays", [], "any", false, false, false, 28), 'widget', ["attr" => ["class" => "form-group pays"]]);
        echo "
                    </div>
                </div>
                <div class=\"col-lg-4\">
                    <div class=\"form-group mb-4  required\" for=\"event_secteur\">
                        <label class=\"cs-label d-block\">Secteur</label>
                        ";
        // line 34
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 34, $this->source); })()), "secteur", [], "any", false, false, false, 34), 'widget', ["attr" => ["class" => "form-group sec"]]);
        echo "
                    </div>
                </div>
                <div class=\"col-lg-4\">
                    <div class=\"form-group mb-4  required\" for=\"event_formatParticipation\">
                        <label class=\"cs-label d-block\">Format de participation</label>

                        ";
        // line 41
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "formatParticipation", [], "any", false, false, false, 41), 'widget');
        echo " 
                    </div>
                </div>
                
                <div class=\"col-lg-6\">
                    <div class=\"form-group mb-4  required\" for=\"event_partenaires\">
                        <label class=\"cs-label d-block\">Partenaires</label>
                         ";
        // line 48
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 48, $this->source); })()), "partenaires", [], "any", false, false, false, 48), 'widget', ["attr" => ["class" => "form-group part"]]);
        echo "
                    </div>
                     <div class=\"form-group mb-4  required\" for=\"event_Organisateur\">
                        <label class=\"cs-label d-block\">Organisateur</label>

                         ";
        // line 53
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 53, $this->source); })()), "Organisateur", [], "any", false, false, false, 53), 'widget');
        echo " 
                    </div>
                </div>
                <div class=\"col-lg-6\">
                    <div class=\"form-group mb-4  required\" for=\"event_typeEvenement\">
                        <label class=\"cs-label d-block\">Type d’événement</label>
                        ";
        // line 60
        echo "                            ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 60, $this->source); })()), "typeEvenement", [], "any", false, false, false, 60), 'widget', ["attr" => ["class" => "form-group te"]]);
        echo "
                        ";
        // line 62
        echo "                         
                    </div>
                    <div class=\"form-group mb-4  required\" for=\"event_typeEvenement\">
                        <label class=\"cs-label d-block\">iiComptes</label>
                        ";
        // line 67
        echo "                            ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 67, $this->source); })()), "comptes", [], "any", false, false, false, 67), 'widget', ["attr" => ["class" => "form-group comptes"]]);
        echo "
                        ";
        // line 69
        echo "                         
                    </div>
                </div>
                <div class=\"col-lg-4\">
                 <div class=\"form-group mb-4  required\" for=\"event_partenaires\">
                        <label class=\"cs-label d-block\">Document</label>
                         ";
        // line 75
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 75, $this->source); })()), "documet", [], "any", false, false, false, 75), 'widget');
        echo "
                           
                    ";
        // line 80
        echo "                    
                    </div>
                </div>    
                <div class=\"col-lg-8\">
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block\">Description</label>

                         ";
        // line 87
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 87, $this->source); })()), "description", [], "any", false, false, false, 87), 'widget', ["attr" => ["rows" => "10"]]);
        echo "
 
                    </div>
                </div>
            </div>

";
        // line 93
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 93, $this->source); })()), 'form_end');
        echo " 
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "event/_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 93,  166 => 87,  157 => 80,  152 => 75,  144 => 69,  139 => 67,  133 => 62,  128 => 60,  119 => 53,  111 => 48,  101 => 41,  91 => 34,  82 => 28,  73 => 22,  63 => 15,  52 => 7,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{{ form_start(form, {'attr': {'id': 'form_event'}}) }}
             <div class=\"row align-items-start mb-4\">
                <div class=\"col-lg-6\">
              
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block required\" for=\"event_nom\">Nom de l’événement</label>
                        {{ form_widget(form.nom) }} 
                        
                    </div>
                </div>
                <div class=\"col-lg-3\">
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block required\" for=\"event_mois\">Mois</label>

                        {{ form_widget(form.mois) }} 
                    </div>
                </div>
                <div class=\"col-lg-3\">
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block required\" for=\"event_annee\">Année</label>

                        {{ form_widget(form.annee) }} 
                    </div>
                </div>
                <div class=\"col-lg-4\">
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block  required\" for=\"event_pays\">Pays</label>
                        {{ form_widget(form.pays ,{'attr': {'class': 'form-group pays'}}) }}
                    </div>
                </div>
                <div class=\"col-lg-4\">
                    <div class=\"form-group mb-4  required\" for=\"event_secteur\">
                        <label class=\"cs-label d-block\">Secteur</label>
                        {{ form_widget(form.secteur ,{'attr': {'class': 'form-group sec'}}) }}
                    </div>
                </div>
                <div class=\"col-lg-4\">
                    <div class=\"form-group mb-4  required\" for=\"event_formatParticipation\">
                        <label class=\"cs-label d-block\">Format de participation</label>

                        {{ form_widget(form.formatParticipation) }} 
                    </div>
                </div>
                
                <div class=\"col-lg-6\">
                    <div class=\"form-group mb-4  required\" for=\"event_partenaires\">
                        <label class=\"cs-label d-block\">Partenaires</label>
                         {{ form_widget(form.partenaires ,{'attr': {'class': 'form-group part'}}) }}
                    </div>
                     <div class=\"form-group mb-4  required\" for=\"event_Organisateur\">
                        <label class=\"cs-label d-block\">Organisateur</label>

                         {{ form_widget(form.Organisateur) }} 
                    </div>
                </div>
                <div class=\"col-lg-6\">
                    <div class=\"form-group mb-4  required\" for=\"event_typeEvenement\">
                        <label class=\"cs-label d-block\">Type d’événement</label>
                        {# <div class=\"radio-holder\"> #}
                            {{ form_widget(form.typeEvenement ,{'attr': {'class': 'form-group te'}}) }}
                        {# </div> #}
                         
                    </div>
                    <div class=\"form-group mb-4  required\" for=\"event_typeEvenement\">
                        <label class=\"cs-label d-block\">iiComptes</label>
                        {# <div class=\"radio-holder\"> #}
                            {{ form_widget(form.comptes ,{'attr': {'class': 'form-group comptes'}}) }}
                        {# </div> #}
                         
                    </div>
                </div>
                <div class=\"col-lg-4\">
                 <div class=\"form-group mb-4  required\" for=\"event_partenaires\">
                        <label class=\"cs-label d-block\">Document</label>
                         {{ form_widget(form.documet) }}
                           
                    {# <span class=\"\" id=\"{{data.id}}\" onclick=\"confirmeRemProjet(this.id)\">
                        <i class=\"fa fa-trash\"></i>
                    </span> #}
                    
                    </div>
                </div>    
                <div class=\"col-lg-8\">
                    <div class=\"form-group mb-4\">
                        <label class=\"cs-label d-block\">Description</label>

                         {{ form_widget(form.description,{attr: {rows: '10'} }) }}
 
                    </div>
                </div>
            </div>

{{ form_end(form) }} 
", "event/_form.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/event/_form.html.twig");
    }
}
