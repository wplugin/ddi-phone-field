<?php
/**
 * Hook loader
 *
 * @package DDI_Phone_Field
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Hook loader class
 *
 * @since 1.0.0
 */
class DDI_Phone_Field_Loader {

    /**
     * Actions array
     *
     * @since 1.0.0
     * @var array
     */
    protected $actions;

    /**
     * Filters array
     *
     * @since 1.0.0
     * @var array
     */
    protected $filters;

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct() {
        $this->actions = array();
        $this->filters = array();
    }

    /**
     * Add action
     *
     * @since 1.0.0
     * @param string $hook Hook name
     * @param object $component Component object
     * @param string $callback Callback method
     * @param int $priority Priority
     * @param int $accepted_args Accepted arguments
     * @return void
     */
    public function add_action($hook, $component, $callback, $priority = 10, $accepted_args = 1) {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * Add filter
     *
     * @since 1.0.0
     * @param string $hook Hook name
     * @param object $component Component object
     * @param string $callback Callback method
     * @param int $priority Priority
     * @param int $accepted_args Accepted arguments
     * @return void
     */
    public function add_filter($hook, $component, $callback, $priority = 10, $accepted_args = 1) {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * Add hook to array
     *
     * @since 1.0.0
     * @param array $hooks Hooks array
     * @param string $hook Hook name
     * @param object $component Component object
     * @param string $callback Callback method
     * @param int $priority Priority
     * @param int $accepted_args Accepted arguments
     * @return array
     */
    private function add($hooks, $hook, $component, $callback, $priority, $accepted_args) {
        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        );

        return $hooks;
    }

    /**
     * Run all hooks
     *
     * @since 1.0.0
     * @return void
     */
    public function run() {
        foreach ($this->filters as $hook) {
            add_filter(
                $hook['hook'],
                array($hook['component'], $hook['callback']),
                $hook['priority'],
                $hook['accepted_args']
            );
        }

        foreach ($this->actions as $hook) {
            add_action(
                $hook['hook'],
                array($hook['component'], $hook['callback']),
                $hook['priority'],
                $hook['accepted_args']
            );
        }
    }
}
