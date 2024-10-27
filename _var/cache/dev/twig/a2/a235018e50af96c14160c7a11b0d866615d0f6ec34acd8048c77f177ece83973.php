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

/* event/edit.html.twig */
class __TwigTemplate_f47e6ad00212f5b4dee1fbffdde14feda10b1fdf045af2821d8454c7464500a2 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'title' => [$this, 'block_title'],
            'sous_title' => [$this, 'block_sous_title'],
            'navbar_right' => [$this, 'block_navbar_right'],
            'navbar_left' => [$this, 'block_navbar_left'],
            'third_header' => [$this, 'block_third_header'],
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/edit.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/edit.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "event/edit.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 2
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 3
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/_style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        // line 6
        echo "\t";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("event.Event"), "html", null, true);
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 8
    public function block_sous_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sous_title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sous_title"));

        // line 9
        echo "<a class=\"navbar-brand\" href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("events_index");
        echo "\">
\t<img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/amdie.png"), "html", null, true);
        echo "\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\talt=\"logo\">
\t\t<div class=\"SousTitre\">
\t\t<strong>AMDIE</strong>
\t|
\t";
        // line 15
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("event.Event")), "html", null, true);
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
        echo "    ";
        // line 21
        echo "    ";
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("MODIFIER_EVENT", (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 21, $this->source); })()))) {
            // line 22
            echo "\t\t <a class=\"btn btn-blue save-btn\" id=\"btn_submit\" href=\"#\">
            <i class=\"fa  fa-save\"></i>
        </a>
   
    <a class=\"btn btn-blue\" href=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_pdf", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 26, $this->source); })()), "id", [], "any", false, false, false, 26)]), "html", null, true);
            echo "\">
        <i class=\"fa  fa-download\"></i>
    </a>
\t";
        }
        // line 30
        echo "    ";
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("SUPPRIMER_EVENT", (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 30, $this->source); })()))) {
            // line 31
            echo "    <form id=\"delete-form\" method=\"post\" action=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_delete", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 31, $this->source); })()), "id", [], "any", false, false, false, 31)]), "html", null, true);
            echo "\">
        <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
        <input type=\"hidden\" name=\"_token\" value=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 33, $this->source); })()), "id", [], "any", false, false, false, 33))), "html", null, true);
            echo "\">
        <button class=\"btn btn-blue\" id=\"delete-item\">
            <i class=\"fa fa-trash\"></i>
        </button>
    </form>
    ";
        }
        
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
        echo "    <a class=\"btn btn-blue\" href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("events_index");
        echo "\">
        <i class=\"fa fa-arrow-left\"></i>
    </a>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 45
    public function block_third_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "third_header"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "third_header"));

        // line 46
        echo "\t";
        echo twig_include($this->env, $context, "event/third_header/_third_header.html.twig");
        echo "

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 49
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 50
        echo "<div class=\"item-details wrape-contact-details\">
    <div class=\"item-details-body item-details-event item-bg-none\">
         <div class=\"row\">
            <!-- content body -->
            <div class=\"col-lg-8 content-info event-info-event \">
                        <div class=\"header\">
                            <ul>
                                <li class=\"active title-btn\">
                                    Information Event
                                </li>
                            </ul>
                        </div>
                        <div class=\"item-details\">
                    <div class=\"item-details-body item-details-contact item-bg-none event-details\" style=\"padding: 0 20px;\">

                        <div class=\"tab-content cs-tab-content cs-tab-contact\">
                            <div class=\"tab-pane fade show active\" id=\"item-details-project\" role=\"tabpanel\">
                                       <!-- start form -->
                                         ";
        // line 68
        echo twig_include($this->env, $context, "event/_form.html.twig", ["button_label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("event.Update")]);
        echo "
                                        ";
        // line 69
        if (twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 69, $this->source); })()), "documet", [], "any", false, false, false, 69)) {
            // line 70
            echo "                                        <div style=\"position: absolute;bottom: 219px;\">
                                          <a href=\"";
            // line 71
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 71, $this->source); })()), "documet", [], "any", false, false, false, 71))), "html", null, true);
            echo "\" target=\"_blink\">Attachement</a> 
                                            <span class=\"\" id=\"";
            // line 72
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 72, $this->source); })()), "id", [], "any", false, false, false, 72), "html", null, true);
            echo "\" onclick=\"confirmEventModalTrash(this.id)\">
                                                <i class=\"fa fa-trash\"></i>
                                            </span>
                                         </div>
                                        ";
        }
        // line 77
        echo "                                        <!-- end form -->
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- content sidebar -->
                  <div class=\"col-lg-4 sidbar-compte\">
                  <div class=\"container container-compte\">
                    <div class=\"row\">

                        <div class=\"compte col-sm comment events-holder\">
                            <div class=\"headerevents\">
                                <ul>
                                    <li class=\"active title-btn\">
                                        Comptes
                                    </li>
                                </ul>
                            </div>
                                <div class=\"profileve wrape-projects\">
                                ";
        // line 99
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 99, $this->source); })()), "comptes", [], "any", false, false, false, 99));
        foreach ($context['_seq'] as $context["_key"] => $context["compte"]) {
            // line 100
            echo "                                <div class=\"ecard\">
                                    
                                    <div class=\"firstinfo\">
                                    <a href=\"";
            // line 103
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("compte_detail", ["id" => twig_get_attribute($this->env, $this->source, $context["compte"], "id", [], "any", false, false, false, 103)]), "html", null, true);
            echo "\">
                                        <img src=\"";
            // line 104
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . ((twig_get_attribute($this->env, $this->source, $context["compte"], "logo", [], "any", false, false, false, 104)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["compte"], "logo", [], "any", false, false, false, 104), "filename", [], "any", false, false, false, 104)) : ("logo_default.png")))), "html", null, true);
            echo "\"
                                            alt=\"\" class=\"clip-circle\">

                                        <div class=\"profileinfo\">
                                            <h1> ";
            // line 108
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["compte"], "nomCompte", [], "any", false, false, false, 108), "html", null, true);
            echo "</h1>
                                            <h3>
                                                ";
            // line 110
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["compte"], "secteurs", [], "any", false, false, false, 110));
            foreach ($context['_seq'] as $context["_key"] => $context["secteur"]) {
                // line 111
                echo "                                                ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["secteur"], "nom", [], "any", false, false, false, 111), "html", null, true);
                echo "
                                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['secteur'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 113
            echo "                                            </h3>
                                            ";
            // line 114
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["compte"], "projets", [], "any", false, false, false, 114));
            foreach ($context['_seq'] as $context["_key"] => $context["projet"]) {
                // line 115
                echo "                                                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["projet"], "status", [], "any", false, false, false, 115));
                foreach ($context['_seq'] as $context["key"] => $context["proj"]) {
                    // line 116
                    echo "                                            <div class=\"projet\">
                                            ";
                    // line 117
                    if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["projet"], "isDeleted", [], "any", false, false, false, 117), false))) {
                        // line 118
                        echo "                                                <a href=\"";
                        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_detail", ["id" => twig_get_attribute($this->env, $this->source, $context["projet"], "id", [], "any", false, false, false, 118)]), "html", null, true);
                        echo "\">
                                                    <h6 class=\"status\">";
                        // line 119
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["projet"], "titre", [], "any", false, false, false, 119), "html", null, true);
                        echo "</h6>
                                                        <span class=\"state active\">#";
                        // line 120
                        echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                        echo "</span>
                                                </a>
                                            ";
                    }
                    // line 123
                    echo "                                            </div>
\t\t\t\t\t\t                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['proj'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 125
                echo "                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['projet'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 126
            echo "
                                        </div>
                                        </a>
                                    </div>
                                </div>


                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['compte'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 134
        echo "                               </div>
                        </div>

                    </div>
                </div>
            </div>
                </div>
            ";
        // line 142
        echo "        </div>
    </div>
</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 146
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 147
        echo "        <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bloodhound.jquery.min.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 148
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/typeahead.jquery.min.js"), "html", null, true);
        echo "\"></script>
        <script>
            \$(\"#btn_submit\").click(function () {
                \$(\"#form_event\").submit();

            });
            \$('.te').select2({
\t\t    width: '100%'
\t        });
            \$('.part').select2({
\t\t    width: '100%'
\t        });
            \$('.comptes').select2({
\t\t    width: '100%'
\t        });
             \$('.sec').select2({
\t\t    width: '100%'
\t        });
             \$('.pays').select2({
\t\t    width: '100%'
\t        });
            
        </script>
        ";
        // line 171
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 171, $this->source); })()), "flashes", [0 => "notice"], "method", false, false, false, 171));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 172
            echo "        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'vos changements ont été bien enregistrés.',
                showConfirmButton: false,
                timer: 3000
            })
        </script>
        
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 183
        echo "
<script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "event/edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  505 => 183,  489 => 172,  485 => 171,  459 => 148,  454 => 147,  444 => 146,  431 => 142,  422 => 134,  409 => 126,  403 => 125,  396 => 123,  390 => 120,  386 => 119,  381 => 118,  379 => 117,  376 => 116,  371 => 115,  367 => 114,  364 => 113,  355 => 111,  351 => 110,  346 => 108,  339 => 104,  335 => 103,  330 => 100,  326 => 99,  302 => 77,  294 => 72,  290 => 71,  287 => 70,  285 => 69,  281 => 68,  261 => 50,  251 => 49,  237 => 46,  227 => 45,  212 => 41,  202 => 40,  185 => 33,  179 => 31,  176 => 30,  169 => 26,  163 => 22,  160 => 21,  158 => 20,  148 => 19,  134 => 15,  126 => 10,  121 => 9,  111 => 8,  98 => 6,  88 => 5,  75 => 3,  65 => 2,  42 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}
{% block stylesheets %}
    <link href=\"{{ asset('css/_style.css') }}\" rel=\"stylesheet\" type=\"text/css\">
{% endblock %}
{% block title %}
\t{{ 'event.Event'| trans }}
{% endblock %}
{% block sous_title %}
<a class=\"navbar-brand\" href=\"{{ path('events_index') }}\">
\t<img src=\"{{ asset('images/amdie.png') }}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\"
\t\talt=\"logo\">
\t\t<div class=\"SousTitre\">
\t\t<strong>AMDIE</strong>
\t|
\t{{ 'event.Event'| trans | upper }}
\t</div>
</a>
{% endblock %}
{% block navbar_right %}
    {# <a class=\"btn btn-blue\" href=\"{{ path('events_index') }}\" tite=\"Liste events\"><i class=\"fa fa-list\"></i> </a> #}
    {% if is_granted('MODIFIER_EVENT', event) %}
\t\t <a class=\"btn btn-blue save-btn\" id=\"btn_submit\" href=\"#\">
            <i class=\"fa  fa-save\"></i>
        </a>
   
    <a class=\"btn btn-blue\" href=\"{{ path('event_pdf',{'id':event.id}) }}\">
        <i class=\"fa  fa-download\"></i>
    </a>
\t{% endif %}
    {% if is_granted('SUPPRIMER_EVENT', event) %}
    <form id=\"delete-form\" method=\"post\" action=\"{{ path('event_delete', {'id': event.id}) }}\">
        <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ event.id) }}\">
        <button class=\"btn btn-blue\" id=\"delete-item\">
            <i class=\"fa fa-trash\"></i>
        </button>
    </form>
    {% endif %}
{% endblock %}
{% block navbar_left %}
    <a class=\"btn btn-blue\" href=\"{{ path('events_index') }}\">
        <i class=\"fa fa-arrow-left\"></i>
    </a>
{% endblock %}
{% block third_header %}
\t{{ include('event/third_header/_third_header.html.twig') }}

{% endblock %}
{% block body %}
<div class=\"item-details wrape-contact-details\">
    <div class=\"item-details-body item-details-event item-bg-none\">
         <div class=\"row\">
            <!-- content body -->
            <div class=\"col-lg-8 content-info event-info-event \">
                        <div class=\"header\">
                            <ul>
                                <li class=\"active title-btn\">
                                    Information Event
                                </li>
                            </ul>
                        </div>
                        <div class=\"item-details\">
                    <div class=\"item-details-body item-details-contact item-bg-none event-details\" style=\"padding: 0 20px;\">

                        <div class=\"tab-content cs-tab-content cs-tab-contact\">
                            <div class=\"tab-pane fade show active\" id=\"item-details-project\" role=\"tabpanel\">
                                       <!-- start form -->
                                         {{ include('event/_form.html.twig', {'button_label': 'event.Update'| trans}) }}
                                        {% if (event.documet)%}
                                        <div style=\"position: absolute;bottom: 219px;\">
                                          <a href=\"{{ asset(\"uploads/\"~ (event.documet)) }}\" target=\"_blink\">Attachement</a> 
                                            <span class=\"\" id=\"{{event.id}}\" onclick=\"confirmEventModalTrash(this.id)\">
                                                <i class=\"fa fa-trash\"></i>
                                            </span>
                                         </div>
                                        {% endif %}
                                        <!-- end form -->
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- content sidebar -->
                  <div class=\"col-lg-4 sidbar-compte\">
                  <div class=\"container container-compte\">
                    <div class=\"row\">

                        <div class=\"compte col-sm comment events-holder\">
                            <div class=\"headerevents\">
                                <ul>
                                    <li class=\"active title-btn\">
                                        Comptes
                                    </li>
                                </ul>
                            </div>
                                <div class=\"profileve wrape-projects\">
                                {% for compte in event.comptes %}
                                <div class=\"ecard\">
                                    
                                    <div class=\"firstinfo\">
                                    <a href=\"{{ path('compte_detail',{id:compte.id}) }}\">
                                        <img src=\"{{ asset(\"uploads/\"~ (compte.logo ? compte.logo.filename: 'logo_default.png')) }}\"
                                            alt=\"\" class=\"clip-circle\">

                                        <div class=\"profileinfo\">
                                            <h1> {{compte.nomCompte}}</h1>
                                            <h3>
                                                {% for secteur in compte.secteurs %}
                                                {{secteur.nom}}
                                                {% endfor %}
                                            </h3>
                                            {% for projet in compte.projets %}
                                                {% for key,proj in projet.status %}
                                            <div class=\"projet\">
                                            {% if(projet.isDeleted == false) %}
                                                <a href=\"{{ path('projets_detail',{'id':projet.id }) }}\">
                                                    <h6 class=\"status\">{{ projet.titre }}</h6>
                                                        <span class=\"state active\">#{{key}}</span>
                                                </a>
                                            {% endif %}
                                            </div>
\t\t\t\t\t\t                    {% endfor %}
                                            {% endfor %}

                                        </div>
                                        </a>
                                    </div>
                                </div>


                                {% endfor %}
                               </div>
                        </div>

                    </div>
                </div>
            </div>
                </div>
            {# <button type=\"submit\" class=\"btn btn-success\" id=\"btn-edit\" value=\"Edit\" style=\"display: none;\">Submit</button> #}
        </div>
    </div>
</div>
{% endblock %}
{% block javascripts %}
        <script type=\"text/javascript\" src=\"{{ asset('js/bloodhound.jquery.min.js') }}\"></script>
        <script type=\"text/javascript\" src=\"{{ asset('js/typeahead.jquery.min.js') }}\"></script>
        <script>
            \$(\"#btn_submit\").click(function () {
                \$(\"#form_event\").submit();

            });
            \$('.te').select2({
\t\t    width: '100%'
\t        });
            \$('.part').select2({
\t\t    width: '100%'
\t        });
            \$('.comptes').select2({
\t\t    width: '100%'
\t        });
             \$('.sec').select2({
\t\t    width: '100%'
\t        });
             \$('.pays').select2({
\t\t    width: '100%'
\t        });
            
        </script>
        {% for message in app.flashes('notice') %}
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'vos changements ont été bien enregistrés.',
                showConfirmButton: false,
                timer: 3000
            })
        </script>
        
    {% endfor %}

<script>
{% endblock %}
", "event/edit.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/event/edit.html.twig");
    }
}
