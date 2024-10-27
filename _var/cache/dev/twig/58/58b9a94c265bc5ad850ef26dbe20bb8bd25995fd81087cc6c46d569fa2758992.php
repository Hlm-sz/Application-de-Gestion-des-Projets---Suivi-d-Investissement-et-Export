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

/* contact/index.html.twig */
class __TwigTemplate_29db901a042db225c443e71dc6c31a59b9b52dd2513a72fed9b8e125670b4ef8 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "contact/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "contact/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "contact/index.html.twig", 1);
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
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("contact.listes_contact"), "html", null, true);
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
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_index");
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
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("contact.Contacts")), "html", null, true);
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
        echo "
<li class=\"nav-item\">
";
        // line 22
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("EXTRACTION_DE_CONTACTS", (isset($context["contact"]) || array_key_exists("contact", $context) ? $context["contact"] : (function () { throw new RuntimeError('Variable "contact" does not exist.', 22, $this->source); })()))) {
            // line 23
            echo "\t<a class=\"btn btn-blue\" href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_export");
            echo "\">
\t\t\t<i class=\"fa fa-download\"></i>
\t</a>
";
        }
        // line 27
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IMPORTATION_DES_FICHIERS_DE_DONNEES", (isset($context["contact"]) || array_key_exists("contact", $context) ? $context["contact"] : (function () { throw new RuntimeError('Variable "contact" does not exist.', 27, $this->source); })()))) {
            // line 28
            echo "\t<a href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_importer");
            echo "\" class=\"btn btn-float text-default btn-blue\">
\t\t<i class=\"fa fa-upload\"></i>
\t</a>
";
        }
        // line 32
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("CREATION_DE_CONTACT", (isset($context["contact"]) || array_key_exists("contact", $context) ? $context["contact"] : (function () { throw new RuntimeError('Variable "contact" does not exist.', 32, $this->source); })()))) {
            // line 33
            echo "<a href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_new");
            echo "\" class=\"btn btn-float text-default btn-blue\">
\t\t<i class=\"fa fa-plus\"></i>
</a>
";
        }
        // line 37
        echo "</li>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 40
    public function block_navbar_left($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "navbar_left"));

        // line 41
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 43
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 44
        echo " <div class=\"row main\">
\t<div class=\"col-md-1  wrape-filter-project\">
\t\t<div class=\"filter-project\">
\t\t\t<a class=\"btn-filtre\" onclick=\"document.querySelector('.main-projects').style.transition='all .3s'; document.querySelector('.main-projects').style.transform == 'translateX(0px)' || !document.querySelector('.main-projects').style.transform ? (document.querySelector('.main-projects').style.transform = 'translateX(310px)') : (document.querySelector('.main-projects').style.transform = 'translateX(0)')\">
\t\t\t\t<img class=\"img-filtre\" src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/icons/filter-project.svg"), "html", null, true);
        echo "\" alt=\"\">
\t\t\t</a>
\t\t\t<div class=\"sidebare-filter \">
\t\t\t\t";
        // line 51
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), 'form_start', ["action" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_filtre"), "attr" => ["id" => "form_filtre"]]);
        echo "
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t<label class=\"cs-label\"></label>
\t\t\t\t\t\t<label class=\"cs-label\">Contact</label>

                        ";
        // line 58
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), "search", [], "any", false, false, false, 58), 'widget', ["attr" => ["class" => "form-group wi87PO search"]]);
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t<label class=\"cs-label\">Canal</label>

\t\t\t\t\t\t\t";
        // line 65
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 65, $this->source); })()), "canal", [], "any", false, false, false, 65), 'widget', ["attr" => ["class" => "form-group wi87PO canal"]]);
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t\t<label class=\"cs-label\">Profil</label>
\t\t\t\t\t\t\t";
        // line 71
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 71, $this->source); })()), "profil", [], "any", false, false, false, 71), 'widget', ["attr" => ["class" => "form-group wi87PO profil"]]);
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t<label class=\"cs-label\">Période de création</label>
\t\t\t\t\t\t\t";
        // line 77
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 77, $this->source); })()), "startdate", [], "any", false, false, false, 77), 'widget', ["attr" => ["class" => "form-group wi87PO startdate"]]);
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>\t
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t\t";
        // line 82
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 82, $this->source); })()), "enddate", [], "any", false, false, false, 82), 'widget', ["attr" => ["class" => "form-group wi87PO enddate"]]);
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
\t\t\t\t\t";
        // line 88
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 88, $this->source); })()), 'form_end');
        echo "
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"col-lg-11 main-projects\">
\t\t<div class=\"row wrapper\">
\t\t\t<div class=\"col-lg-3 wrape-list-project\">
\t\t\t\t<div class=\"items-container-header\">
\t\t\t\t\t<h3>Contacts </h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"scroll_container_project\">
\t\t\t\t\t<div class=\"scroll_content_project parent-ajax\">
\t\t\t\t\t\t<ul id=\"list-project \">
\t\t\t\t\t\t\t";
        // line 101
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["contacts"]) || array_key_exists("contacts", $context) ? $context["contacts"] : (function () { throw new RuntimeError('Variable "contacts" does not exist.', 101, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["contact"]) {
            // line 102
            echo "\t\t\t\t\t\t\t<li class=\"list-contacts scroll-btn\" data-id=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["contact"], "id", [], "any", false, false, false, 102), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\tdata-source=\"";
            // line 103
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_show", ["id" => twig_get_attribute($this->env, $this->source, $context["contact"], "id", [], "any", false, false, false, 103)]), "html", null, true);
            echo "\">

\t\t\t\t\t\t\t\t<div class=\"content-list-comptes\">
\t\t\t\t\t\t\t\t\t<div class=\"content content_pro\">
\t\t\t\t\t\t\t\t\t\t";
            // line 110
            echo "\t\t\t\t\t\t\t\t\t\t<span class=\"item-logo\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"name\">";
            // line 111
            echo twig_escape_filter($this->env, ((twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, $context["contact"], "prenom", [], "any", false, false, false, 111)) . " ") . twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 111))), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"item-title \">
\t\t\t\t\t\t\t\t\t\t\t";
            // line 114
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, twig_get_attribute($this->env, $this->source, $context["contact"], "Prenom", [], "any", false, false, false, 114)), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["contact"], "Nom", [], "any", false, false, false, 114), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t <span class=\"item-date\">
                                            ";
            // line 117
            ((twig_get_attribute($this->env, $this->source, $context["contact"], "dateCreation", [], "any", false, false, false, 117)) ? (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["contact"], "dateCreation", [], "any", false, false, false, 117), "d/m/Y"), "html", null, true))) : (print ("")));
            echo "
                                        </span>
\t\t\t\t\t\t\t\t\t\t";
            // line 119
            if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["contact"], "isActive", [], "any", false, false, false, 119), 0))) {
                // line 120
                echo "\t\t\t\t\t\t\t\t\t\t";
                if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 120, $this->source); })()), "user", [], "any", false, false, false, 120), "groupe", [], "any", false, false, false, 120), "id", [], "any", false, false, false, 120), 29))) {
                    // line 121
                    echo " \t\t\t\t\t\t\t\t\t\t<span class=\"badge badge-danger floricon\">À Valider</span>
\t\t\t\t\t\t\t\t\t";
                }
                // line 123
                echo " \t\t\t\t\t\t\t\t\t\t";
            }
            // line 124
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t";
            // line 129
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contact'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 132
        echo "\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-9  body-container\">
\t\t\t\t";
        // line 143
        echo "\t\t\t\t<div id=\"item-details-wrapper\" style=\"margin-left: 15px;\">
\t\t\t\t\t<div class=\"item-details-empty\">
\t\t\t\t\t\t<img src=\"";
        // line 145
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/dashboard.png"), "html", null, true);
        echo "\" class=\"img-fluid\">
\t\t\t\t\t\t<h3>Merci de sélectionner un contact</h3>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div> ";
        // line 152
        echo "</div> ";
        // line 153
        echo "<button class=\"scroltop\">
\t<i class=\"fa fa-angle-double-up\"></i>
\t</button>

<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js\"></script>
<script src=\"";
        // line 158
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
<script>
\$(document).ready(function() {
    \$('.search').select2();
\t\$('.canal').select2();
    \$('.profil').select2();
\t
});
</script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "contact/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  380 => 158,  373 => 153,  371 => 152,  362 => 145,  358 => 143,  351 => 132,  343 => 129,  340 => 124,  337 => 123,  333 => 121,  330 => 120,  328 => 119,  323 => 117,  315 => 114,  309 => 111,  306 => 110,  299 => 103,  294 => 102,  290 => 101,  274 => 88,  265 => 82,  257 => 77,  248 => 71,  239 => 65,  229 => 58,  219 => 51,  213 => 48,  207 => 44,  197 => 43,  186 => 41,  176 => 40,  165 => 37,  157 => 33,  155 => 32,  147 => 28,  145 => 27,  137 => 23,  135 => 22,  131 => 20,  121 => 19,  107 => 14,  99 => 9,  94 => 8,  84 => 7,  72 => 4,  62 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}
{{'contact.listes_contact'| trans}}
{% endblock %}

{% block sous_title %}
<a class=\"navbar-brand\" href=\"{{ path('contact_index') }}\">
\t<img src=\"{{ asset('images/amdie.png') }}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\talt=\"logo\">
\t\t<div class=\"SousTitre\">
\t\t<strong>AMDIE</strong>
\t|
\t{{'contact.Contacts'| trans | upper }}
\t</div>
</a>
{% endblock %}

{% block navbar_right %}

<li class=\"nav-item\">
{% if is_granted('EXTRACTION_DE_CONTACTS', contact) %}
\t<a class=\"btn btn-blue\" href=\"{{ path('contact_export') }}\">
\t\t\t<i class=\"fa fa-download\"></i>
\t</a>
{% endif %}
{% if is_granted('IMPORTATION_DES_FICHIERS_DE_DONNEES', contact) %}
\t<a href=\"{{ path('contact_importer') }}\" class=\"btn btn-float text-default btn-blue\">
\t\t<i class=\"fa fa-upload\"></i>
\t</a>
{% endif %}
{% if is_granted('CREATION_DE_CONTACT', contact) %}
<a href=\"{{ path('contact_new') }}\" class=\"btn btn-float text-default btn-blue\">
\t\t<i class=\"fa fa-plus\"></i>
</a>
{% endif %}
</li>
{% endblock %}

{% block navbar_left %}

{% endblock %}
{% block body %}
 <div class=\"row main\">
\t<div class=\"col-md-1  wrape-filter-project\">
\t\t<div class=\"filter-project\">
\t\t\t<a class=\"btn-filtre\" onclick=\"document.querySelector('.main-projects').style.transition='all .3s'; document.querySelector('.main-projects').style.transform == 'translateX(0px)' || !document.querySelector('.main-projects').style.transform ? (document.querySelector('.main-projects').style.transform = 'translateX(310px)') : (document.querySelector('.main-projects').style.transform = 'translateX(0)')\">
\t\t\t\t<img class=\"img-filtre\" src=\"{{ asset('images/icons/filter-project.svg') }}\" alt=\"\">
\t\t\t</a>
\t\t\t<div class=\"sidebare-filter \">
\t\t\t\t{{ form_start(form,{'action': path('contact_filtre'),'attr':{'id':'form_filtre'}}) }}
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t<label class=\"cs-label\"></label>
\t\t\t\t\t\t<label class=\"cs-label\">Contact</label>

                        {{ form_widget(form.search ,{'attr': {'class': 'form-group wi87PO search'}}) }}
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t<label class=\"cs-label\">Canal</label>

\t\t\t\t\t\t\t{{ form_widget(form.canal ,{'attr': {'class': 'form-group wi87PO canal'}}) }}
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t\t<label class=\"cs-label\">Profil</label>
\t\t\t\t\t\t\t{{ form_widget(form.profil ,{'attr': {'class': 'form-group wi87PO profil'}}) }}
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t<label class=\"cs-label\">Période de création</label>
\t\t\t\t\t\t\t{{ form_widget(form.startdate ,{'attr': {'class': 'form-group wi87PO startdate'}}) }}
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>\t
\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t<div class=\"form-group mb-4\">
\t\t\t\t\t\t\t{{ form_widget(form.enddate ,{'attr': {'class': 'form-group wi87PO enddate'}}) }}
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<button style=\"width: 100%\" class=\"btn btn-btn-blue\" id=\"filtre\">Filtre</button>
\t\t\t\t\t{{ form_end(form) }}
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"col-lg-11 main-projects\">
\t\t<div class=\"row wrapper\">
\t\t\t<div class=\"col-lg-3 wrape-list-project\">
\t\t\t\t<div class=\"items-container-header\">
\t\t\t\t\t<h3>Contacts </h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"scroll_container_project\">
\t\t\t\t\t<div class=\"scroll_content_project parent-ajax\">
\t\t\t\t\t\t<ul id=\"list-project \">
\t\t\t\t\t\t\t{% for contact in contacts %}
\t\t\t\t\t\t\t<li class=\"list-contacts scroll-btn\" data-id=\"{{ contact.id }}\"
\t\t\t\t\t\t\t\tdata-source=\"{{ path('contact_show', {'id': contact.id }) }}\">

\t\t\t\t\t\t\t\t<div class=\"content-list-comptes\">
\t\t\t\t\t\t\t\t\t<div class=\"content content_pro\">
\t\t\t\t\t\t\t\t\t\t{# <span class=\"item-logo\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset(\"uploads/\"~ (project.compte.logo ? project.compte.logo.filename: 'logo_default.png')) }}\" alt=\"\" class=\"img-fluid\">
\t\t\t\t\t\t\t\t\t\t</span> #}
\t\t\t\t\t\t\t\t\t\t<span class=\"item-logo\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"name\">{{ contact.prenom|upper ~' '~ contact.nom|upper }}</div>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"item-title \">
\t\t\t\t\t\t\t\t\t\t\t{{ contact.Prenom|capitalize }} {{ contact.Nom }}
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t <span class=\"item-date\">
                                            {{ contact.dateCreation ? contact.dateCreation|date('d/m/Y'):'' }}
                                        </span>
\t\t\t\t\t\t\t\t\t\t{% if contact.isActive == 0 %}
\t\t\t\t\t\t\t\t\t\t{% if app.user.groupe.id ==29 %}
 \t\t\t\t\t\t\t\t\t\t<span class=\"badge badge-danger floricon\">À Valider</span>
\t\t\t\t\t\t\t\t\t{% endif %}
 \t\t\t\t\t\t\t\t\t\t{% endif %}
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
\t\t\t\t\t\t<h3>Merci de sélectionner un contact</h3>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div> {#  End main-projects #}
</div> {#  End Main Row #}
<button class=\"scroltop\">
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
<script>
\$(document).ready(function() {
    \$('.search').select2();
\t\$('.canal').select2();
    \$('.profil').select2();
\t
});
</script>
{% endblock %}
", "contact/index.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/contact/index.html.twig");
    }
}
