import './bootstrap';

import React from 'react';
import { createRoot } from 'react-dom/client';

// Dynamic mount registry for React islands
const mounts = {
    TextInput: React.lazy(() => import('./components/TextInput.jsx')),
    SelectAutocomplete: React.lazy(() => import('./components/SelectAutocomplete.jsx')),
};

function mountReactIslands() {
    const nodes = document.querySelectorAll('[data-react-component]');
    nodes.forEach((node) => {
        const componentName = node.getAttribute('data-react-component');
        const propsJson = node.getAttribute('data-props') || '{}';
        const ComponentLazy = mounts[componentName];
        if (!ComponentLazy) return;
        let props = {};
        try {
            props = JSON.parse(propsJson);
        } catch (_) {}

        const root = createRoot(node);
        root.render(
            React.createElement(React.Suspense, { fallback: null },
                React.createElement(ComponentLazy, props)
            )
        );
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mountReactIslands);
} else {
    mountReactIslands();
}

