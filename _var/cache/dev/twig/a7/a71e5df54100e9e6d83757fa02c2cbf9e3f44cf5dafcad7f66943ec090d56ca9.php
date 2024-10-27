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

/* security/login.html.twig */
class __TwigTemplate_d8d4e4c3b38d0e164803bef713791d78820eef19ed5f31b5eb50d3ee298f6a9b extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<meta charset=\"UTF-8\">
\t<title>
        ";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        // line 9
        echo "\t\t| CRM AMDIE
\t</title>

\t<meta charset=\"utf-8\">
\t<link rel=\"icon\" type=\"image/png\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/amdie.png"), "html", null, true);
        echo "\" />
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">
\t<link rel=\"stylesheet\" href=\"/css/style.css\">
\t<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>
</head>
<body>
<div class=\"desktop\">
<div class=\"mainPagelogin\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-lg-7 col-md-6\">
\t\t\t\t<div class=\"descLogin\">
\t\t\t\t\t<div class=\"imgLogin\">
\t\t\t\t\t\t";
        // line 27
        echo "\t\t\t\t\t\t<img src=\"/images/illustration.png\" alt=\"\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"textLogin\">
\t\t\t\t\t\t<div class=\"titre-textLogin\">
\t\t\t\t\t\t\t<h1> Doing business with Morocco </h1>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"desc-textLogin\">
\t\t\t\t\t\t\t<p> Cette solution CRM vise à suivre le funnel commercial des clients à prospecter par l'AMDIE </p>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-5 col-md-6\">
\t\t\t\t<div class=\"mainBlocLogin\">
\t\t\t\t  <div class=\"blocLogin\">
\t\t\t\t\t  <div class=\"imgInterneLogin\">
\t\t\t\t\t\t  <img src=\"/images/logoAmdie.png\" alt=\"\">
\t\t\t\t\t  </div>
\t\t\t\t\t\t<form method=\"post\">
\t\t\t\t\t\t\t";
        // line 47
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 47, $this->source); })())) {
            // line 48
            echo "\t\t\t\t\t\t\t\t<div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 48, $this->source); })()), "messageKey", [], "any", false, false, false, 48), twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 48, $this->source); })()), "messageData", [], "any", false, false, false, 48), "security"), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t";
        }
        // line 50
        echo "
\t\t\t\t\t\t\t";
        // line 51
        if (twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 51, $this->source); })()), "user", [], "any", false, false, false, 51)) {
            // line 52
            echo "\t\t\t\t\t\t\t\t<div class=\"mb-3\">
\t\t\t\t\t\t\t\t\t{'login.your_are' | trans}
\t\t\t\t\t\t\t\t\t";
            // line 54
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 54, $this->source); })()), "user", [], "any", false, false, false, 54), "username", [], "any", false, false, false, 54), "html", null, true);
            echo ",
\t\t\t\t\t\t\t\t\t<a href=\"";
            // line 55
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            echo "\">Logout</a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        }
        // line 58
        echo "
\t\t\t\t\t\t\t<h1 class=\"h3 mb-3 font-weight-normal titleForm\"> Identification </h1>
\t\t\t\t\t\t\t<p class=\"sousTitreLogin\"> identifiez-vous pour accéder à votre espace CRM </p>
\t\t\t\t\t\t\t<div class=\"selectLogin\">
\t\t\t\t\t\t\t\t<label for=\"inputEmail\" class=\"userLogin\">E-Mail</label>
\t\t\t\t\t\t\t\t<input type=\"email\" value=\"";
        // line 63
        echo twig_escape_filter($this->env, (isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 63, $this->source); })()), "html", null, true);
        echo "\" name=\"email\" id=\"inputEmail\" class=\"form-control\" required autofocus>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"selectPassword\">
\t\t\t\t\t\t\t\t<label for=\"inputPassword\" class=\"PasswordLogin\">  Password </label>
\t\t\t\t\t\t\t\t<input type=\"password\" name=\"password\" id=\"inputPassword\" class=\"form-control\" required>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\">
\t\t\t\t\t\t\t<button class=\"btn btn-lg btnLoginForm\" type=\"submit\">
\t\t\t\t\t\t\t\tSe connecter
\t\t\t\t\t\t\t</button>

\t\t\t\t\t\t\t<p class=\"copyright\">
\t\t\t\t\t\t\t\t© 2021 Copyright Moroccan Investment and Export Development Agency (AMDIE)
\t\t\t\t\t\t\t </p>
\t\t\t\t\t\t</form>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>

</div>
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
</div>
</div>

</body>
</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 6
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        // line 7
        echo "\t\t\tLogin
        ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "security/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 7,  193 => 6,  140 => 69,  131 => 63,  124 => 58,  118 => 55,  114 => 54,  110 => 52,  108 => 51,  105 => 50,  99 => 48,  97 => 47,  75 => 27,  59 => 13,  53 => 9,  51 => 6,  44 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
\t<meta charset=\"UTF-8\">
\t<title>
        {% block title %}
\t\t\tLogin
        {% endblock %}
\t\t| CRM AMDIE
\t</title>

\t<meta charset=\"utf-8\">
\t<link rel=\"icon\" type=\"image/png\" href=\"{{ asset('images/amdie.png') }}\" />
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">
\t<link rel=\"stylesheet\" href=\"/css/style.css\">
\t<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>
</head>
<body>
<div class=\"desktop\">
<div class=\"mainPagelogin\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-lg-7 col-md-6\">
\t\t\t\t<div class=\"descLogin\">
\t\t\t\t\t<div class=\"imgLogin\">
\t\t\t\t\t\t{# <img src=\"../../public/images/illustration.png\" alt=\"\"> #}
\t\t\t\t\t\t<img src=\"/images/illustration.png\" alt=\"\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"textLogin\">
\t\t\t\t\t\t<div class=\"titre-textLogin\">
\t\t\t\t\t\t\t<h1> Doing business with Morocco </h1>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"desc-textLogin\">
\t\t\t\t\t\t\t<p> Cette solution CRM vise à suivre le funnel commercial des clients à prospecter par l'AMDIE </p>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-5 col-md-6\">
\t\t\t\t<div class=\"mainBlocLogin\">
\t\t\t\t  <div class=\"blocLogin\">
\t\t\t\t\t  <div class=\"imgInterneLogin\">
\t\t\t\t\t\t  <img src=\"/images/logoAmdie.png\" alt=\"\">
\t\t\t\t\t  </div>
\t\t\t\t\t\t<form method=\"post\">
\t\t\t\t\t\t\t{% if error %}
\t\t\t\t\t\t\t\t<div class=\"alert alert-danger\">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
\t\t\t\t\t\t\t{% endif %}

\t\t\t\t\t\t\t{% if app.user %}
\t\t\t\t\t\t\t\t<div class=\"mb-3\">
\t\t\t\t\t\t\t\t\t{'login.your_are' | trans}
\t\t\t\t\t\t\t\t\t{{ app.user.username }},
\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_logout') }}\">Logout</a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t{% endif %}

\t\t\t\t\t\t\t<h1 class=\"h3 mb-3 font-weight-normal titleForm\"> Identification </h1>
\t\t\t\t\t\t\t<p class=\"sousTitreLogin\"> identifiez-vous pour accéder à votre espace CRM </p>
\t\t\t\t\t\t\t<div class=\"selectLogin\">
\t\t\t\t\t\t\t\t<label for=\"inputEmail\" class=\"userLogin\">E-Mail</label>
\t\t\t\t\t\t\t\t<input type=\"email\" value=\"{{ last_username }}\" name=\"email\" id=\"inputEmail\" class=\"form-control\" required autofocus>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"selectPassword\">
\t\t\t\t\t\t\t\t<label for=\"inputPassword\" class=\"PasswordLogin\">  Password </label>
\t\t\t\t\t\t\t\t<input type=\"password\" name=\"password\" id=\"inputPassword\" class=\"form-control\" required>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">
\t\t\t\t\t\t\t<button class=\"btn btn-lg btnLoginForm\" type=\"submit\">
\t\t\t\t\t\t\t\tSe connecter
\t\t\t\t\t\t\t</button>

\t\t\t\t\t\t\t<p class=\"copyright\">
\t\t\t\t\t\t\t\t© 2021 Copyright Moroccan Investment and Export Development Agency (AMDIE)
\t\t\t\t\t\t\t </p>
\t\t\t\t\t\t</form>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>

</div>
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
</div>
</div>

</body>
</html>
", "security/login.html.twig", "/var/www/html/MDM/Qualif/20240311/CRM_AMDIE_20240311/var/www/CRM_AMDIE/templates/security/login.html.twig");
    }
}
