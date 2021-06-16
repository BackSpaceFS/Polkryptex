<?php

/**
 * @package   Polkryptex
 *
 * @copyright Copyright (c) 2021 - Kacper J., Pawel L., Filip S., Szymon K., Leszek P.
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Polkryptex\Core;

use Polkryptex\Core\Components\Options;
//use Illuminate\View\Component;
/**
 * @author Leszek P.
 */
class Controller extends Blade
{
    protected Options $options;

    protected bool $fullScreen = false;

    protected ?string $name;

    protected ?string $namespace;

    protected ?string $displayName;

    protected ?string $baseUrl;

    protected array $variables = [];

    protected array $bodyClasses = [];

    protected array $scripts = [];

    protected array $styles = [];

    public function __construct(string $namespace)
    {
        $this->options = Registry::get('Options');
        $this->setupNamespace($namespace);
        $this->setupController();

        if (method_exists($this, 'init')) {
            $this->{'init'}();
        }

        $this->print();

        if (method_exists($this, 'done')) {
            $this->{'done'}();
        }

        \Polkryptex\Core\Application::stop();
    }

    private function setupNamespace(string $namespace)
    {
        $this->namespace = $namespace;
        $this->name = strtolower(str_replace('\\', '-', $namespace));
        $this->viewData['title'] = $this->name;

        $this->setViewPath(Shared\Utils::namespaceToBlade($namespace));
    }

    private function setupController(): void
    {
        parent::__construct();
        $this->baseUrl = \Polkryptex\Core\Shared\Http::baseUrl();

        $this->registerTranslation();
        $this->registerCoreScripts();
        $this->setDefaultClasses();
    }

    protected function print(): void
    {
        $this->setDefaultViewData();
        $this->isDebug($this->getVariable('debug'));
        $this->bladePrint();
    }

    private function registerTranslation(): void
    {
        Registry::get('Translator')->setLanguage('pl_PL');
        $this->addData('language', 'pl');
        $this->addData('noTranslate', false);
    }

    private function registerCoreScripts(): void
    {
        $this->queueInternalScript('app.min');
        $this->queueInternalStyle('main.min');

        $this->registerPageScript();
    }

    private function registerPageScript(): void
    {
        if(is_file(ABSPATH . 'public/js/pages/' . $this->name . '.js'))
        {
            $this->queueInternalScript('pages/' . $this->name);
        }
    }

    private function setDefaultClasses(): void
    {
        $this->addBodyClass('polkryptex');
        $this->addBodyClass('theme-light');
        $this->addBodyClass('page-' . ($this->fullScreen ? 'fullscreen' : 'regular'));
        $this->addBodyClass('page-' . strtolower($this->name));
    }

    protected function setDefaultViewData(): void
    {
        $this->addData('installed', defined('APP_VERSION'), false);
        $this->addData('debug', ($this->getVariable('debug') || !defined('APP_VERSION')));

        $this->addData('baseUrl', $this->baseUrl);
        $this->addData('ajax', $this->baseUrl . 'request/');
        $this->addData('bodyClasses', implode(' ', $this->bodyClasses));
        $this->addData('styles', $this->styles, false);
        $this->addData('scripts', $this->scripts, false);
        $this->addData('fullscreen', $this->fullScreen);
        $this->addData('csrfToken', \Polkryptex\Core\Shared\Crypter::salter(64), false);

        $this->addData('auth', ['user' => ''], false);

        $this->addData('importmap', [
            'imports' => [
                'js-cookie' => 'https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.mjs',
                'popperjs' => 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js',
                'bootstrap' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.esm.js'
            ]
        ], false);

        $this->addData('props', $this->vueProps);
    }

    protected function getVariable(string $name, bool $update = false)
    {
        if (empty($this->variables) || $update) {
            $this->variables = Registry::get('Variables')->getAll();
        }

        return $this->variables[$name] ?? null;
    }

    protected function queueScript(string $url, ?string $sri = null, ?string $version = null, ?string $type = "text/javascript")
    {
        $this->scripts[] = [
            'src'  => $url . ($version != null ? '?v=' . $version : ''),
            'sri'  => $sri,
            'type' => $type
        ];
    }

    protected function queueInternalScript(string $path): void
    {
        $this->queueScript($this->baseUrl . 'js/' . $path . '.js', null, $this->getVariable('version'), 'module');
    }

    protected function queueStyle(string $url, ?string $sri = null, ?string $version = null): void
    {
        $this->styles[] = [
            'src' => $url . ($version != null ? '?v=' . $version : ''),
            'sri' => $sri
        ];
    }

    protected function queueInternalStyle(string $path): void
    {
        $this->queueStyle($this->baseUrl . 'css/' . $path . '.css', null, $this->getVariable('version'));
    }

    protected function addBodyClass(string $class): void
    {
        $this->bodyClasses[] = $class;
    }

    protected function setTitle($title)
    {
        $this->viewData['title'] = $this->__($title);
    }

    protected function setAsFullScreen(): void
    {
        $this->fullScreen = true;
    }

    protected function redirect(?string $path = null): void
    {
        \Polkryptex\Core\Shared\Http::redirect($this->baseUrl . $path, false);
    }

    protected function getOption(string $name)
    {
        $this->options->get($name);
    }

    protected function __(string $text, ?array $variables = null): ?string
    {
        return \Polkryptex\Core\Components\Translator::translate($text);
    }
}
