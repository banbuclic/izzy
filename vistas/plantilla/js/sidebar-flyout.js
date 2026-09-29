(function () {
    'use strict';

    var sidebar = document.querySelector('.izzy-sidebar');
    if (!sidebar) return;

    var desktopQuery = window.matchMedia('(min-width: 992px) and (hover: hover) and (pointer: fine)');
    var modules = Array.prototype.slice.call(
        sidebar.querySelectorAll('.izzy-sidebar-module-has-flyout[data-flyout-target]')
    );

    if (!modules.length) return;

    var panel = document.createElement('div');
    panel.className = 'izzy-sidebar-flyout';
    panel.setAttribute('role', 'menu');
    panel.setAttribute('aria-hidden', 'true');
    document.body.appendChild(panel);

    var subPanel = document.createElement('div');
    subPanel.className = 'izzy-sidebar-flyout izzy-sidebar-subflyout';
    subPanel.setAttribute('role', 'menu');
    subPanel.setAttribute('aria-hidden', 'true');
    document.body.appendChild(subPanel);

    var currentTrigger = null;
    var currentNestedTrigger = null;
    var nestedSources = new WeakMap();
    var closeTimer = null;

    function clearCloseTimer() {
        if (closeTimer) {
            window.clearTimeout(closeTimer);
            closeTimer = null;
        }
    }

    function scheduleClose() {
        clearCloseTimer();
        closeTimer = window.setTimeout(closeFlyout, 140);
    }

    function cleanClone(node) {
        if (!node) return null;
        var clone = node.cloneNode(true);
        clone.removeAttribute('id');
        clone.removeAttribute('data-toggle');
        clone.removeAttribute('data-target');
        clone.removeAttribute('data-parent');
        clone.removeAttribute('aria-controls');
        clone.removeAttribute('aria-expanded');
        clone.removeAttribute('style');
        clone.classList.remove('nav-link', 'link', 'collapsed');
        return clone;
    }

    function isHidden(link) {
        if (!link) return true;
        if (link.classList.contains('perm-hidden')) return true;
        if (link.style && link.style.display === 'none') return true;
        return false;
    }

    function prepareDirectLink(sourceLink) {
        var link = cleanClone(sourceLink);
        if (!link) return null;

        link.className = 'izzy-flyout-link';
        link.setAttribute('role', 'menuitem');

        var arrow = link.querySelector('.sb-sidenav-collapse-arrow');
        if (arrow) arrow.remove();

        return link;
    }

    function prepareNestedParent(sourceLink, nestedNav) {
        var link = cleanClone(sourceLink);
        if (!link) return null;

        link.className = 'izzy-flyout-link izzy-flyout-parent';
        link.setAttribute('role', 'menuitem');
        link.setAttribute('href', '#');
        link.setAttribute('aria-haspopup', 'true');
        link.setAttribute('aria-expanded', 'false');

        nestedSources.set(link, nestedNav);
        return link;
    }

    // Primer panel: muestra exactamente el nivel 1 real del módulo.
    // Si una opción tiene un segundo nivel (por ejemplo Reportes),
    // se conserva como opción real y abre un segundo panel sin encabezados.
    function renderPrimaryNav(sourceNav, targetContainer) {
        if (!sourceNav) return 0;

        var children = Array.prototype.slice.call(sourceNav.children);
        var added = 0;

        for (var i = 0; i < children.length; i++) {
            var child = children[i];
            if (!child.matches || !child.matches('a.nav-link')) continue;
            if (isHidden(child)) continue;

            var next = children[i + 1];
            var hasNested = !!(next && next.classList && next.classList.contains('collapse'));

            if (hasNested) {
                var nestedNav = next.querySelector('nav');
                var parentLink = prepareNestedParent(child, nestedNav);

                if (parentLink) {
                    targetContainer.appendChild(parentLink);
                    added++;
                }

                i++;
                continue;
            }

            var directLink = prepareDirectLink(child);
            if (!directLink) continue;

            targetContainer.appendChild(directLink);
            added++;
        }

        return added;
    }

    // Segundo panel: lista final de enlaces, sin títulos ni subtítulos.
    function renderFinalNav(sourceNav, targetContainer) {
        if (!sourceNav) return 0;

        var children = Array.prototype.slice.call(sourceNav.children);
        var added = 0;

        for (var i = 0; i < children.length; i++) {
            var child = children[i];
            if (!child.matches || !child.matches('a.nav-link')) continue;
            if (isHidden(child)) continue;

            var next = children[i + 1];
            var hasNested = !!(next && next.classList && next.classList.contains('collapse'));

            if (hasNested) {
                var nestedNav = next.querySelector('nav');
                added += renderFinalNav(nestedNav, targetContainer);
                i++;
                continue;
            }

            var link = prepareDirectLink(child);
            if (!link) continue;

            targetContainer.appendChild(link);
            added++;
        }

        return added;
    }

    function buildFlyout(trigger) {
        var selector = trigger.getAttribute('data-flyout-target');
        if (!selector) return false;

        var source = sidebar.querySelector(selector);
        if (!source) return false;

        var sourceNav = source.querySelector('nav');
        if (!sourceNav) return false;

        panel.innerHTML = '';
        subPanel.innerHTML = '';
        nestedSources = new WeakMap();
        closeNested();

        var body = document.createElement('div');
        body.className = 'izzy-sidebar-flyout-body';

        var count = renderPrimaryNav(sourceNav, body);
        if (!count) return false;

        panel.appendChild(body);
        return true;
    }

    function buildNestedFlyout(trigger) {
        var sourceNav = nestedSources.get(trigger);
        if (!sourceNav) return false;

        subPanel.innerHTML = '';

        var body = document.createElement('div');
        body.className = 'izzy-sidebar-flyout-body';

        var count = renderFinalNav(sourceNav, body);
        if (!count) return false;

        subPanel.appendChild(body);
        return true;
    }

    function positionFlyout(trigger) {
        var rect = trigger.getBoundingClientRect();
        var gap = 9;
        var viewportGap = 12;

        panel.classList.remove('opens-left');
        panel.style.left = '0px';
        panel.style.top = '0px';
        panel.style.maxHeight = Math.max(120, window.innerHeight - (viewportGap * 2)) + 'px';

        var body = panel.querySelector('.izzy-sidebar-flyout-body');
        if (body) {
            body.style.maxHeight = Math.max(110, window.innerHeight - (viewportGap * 2)) + 'px';
        }

        var panelRect = panel.getBoundingClientRect();
        var spaceRight = window.innerWidth - rect.right - viewportGap;
        var spaceLeft = rect.left - viewportGap;
        var openLeft = spaceRight < panelRect.width + gap && spaceLeft > spaceRight;

        var left;
        if (openLeft) {
            panel.classList.add('opens-left');
            left = rect.left - panelRect.width - gap;
        } else {
            left = rect.right + gap;
        }

        left = Math.max(viewportGap, Math.min(left, window.innerWidth - panelRect.width - viewportGap));

        var triggerCenter = rect.top + (rect.height / 2);
        var centeredTop = triggerCenter - (panelRect.height / 2);
        var top = Math.max(viewportGap, centeredTop);

        if (top + panelRect.height > window.innerHeight - viewportGap) {
            top = Math.max(viewportGap, window.innerHeight - panelRect.height - viewportGap);
        }

        var arrowTop = triggerCenter - top - 6;
        arrowTop = Math.max(14, Math.min(panelRect.height - 20, arrowTop));

        panel.style.left = Math.round(left) + 'px';
        panel.style.top = Math.round(top) + 'px';
        panel.style.setProperty('--izzy-flyout-arrow-top', Math.round(arrowTop) + 'px');

        if (currentNestedTrigger && subPanel.classList.contains('is-open')) {
            positionNestedFlyout(currentNestedTrigger);
        }
    }

    function positionNestedFlyout(trigger) {
        var triggerRect = trigger.getBoundingClientRect();
        var parentRect = panel.getBoundingClientRect();
        var gap = 9;
        var viewportGap = 12;

        subPanel.classList.remove('opens-left');
        subPanel.style.left = '0px';
        subPanel.style.top = '0px';
        subPanel.style.maxHeight = Math.max(120, window.innerHeight - (viewportGap * 2)) + 'px';

        var body = subPanel.querySelector('.izzy-sidebar-flyout-body');
        if (body) {
            body.style.maxHeight = Math.max(110, window.innerHeight - (viewportGap * 2)) + 'px';
        }

        var subRect = subPanel.getBoundingClientRect();
        var spaceRight = window.innerWidth - parentRect.right - viewportGap;
        var spaceLeft = parentRect.left - viewportGap;
        var openLeft = spaceRight < subRect.width + gap && spaceLeft > spaceRight;

        var left;
        if (openLeft) {
            subPanel.classList.add('opens-left');
            left = parentRect.left - subRect.width - gap;
        } else {
            left = parentRect.right + gap;
        }

        left = Math.max(viewportGap, Math.min(left, window.innerWidth - subRect.width - viewportGap));

        var triggerCenter = triggerRect.top + (triggerRect.height / 2);
        var top = triggerCenter - (subRect.height / 2);
        top = Math.max(viewportGap, Math.min(top, window.innerHeight - subRect.height - viewportGap));

        var arrowTop = triggerCenter - top - 6;
        arrowTop = Math.max(14, Math.min(subRect.height - 20, arrowTop));

        subPanel.style.left = Math.round(left) + 'px';
        subPanel.style.top = Math.round(top) + 'px';
        subPanel.style.setProperty('--izzy-flyout-arrow-top', Math.round(arrowTop) + 'px');
    }

    function showNested(trigger) {
        if (!desktopQuery.matches) return;

        clearCloseTimer();

        if (currentNestedTrigger && currentNestedTrigger !== trigger) {
            currentNestedTrigger.classList.remove('is-nested-open');
            currentNestedTrigger.setAttribute('aria-expanded', 'false');
        }

        if (!buildNestedFlyout(trigger)) {
            closeNested();
            return;
        }

        currentNestedTrigger = trigger;
        currentNestedTrigger.classList.add('is-nested-open');
        currentNestedTrigger.setAttribute('aria-expanded', 'true');

        subPanel.classList.add('is-open');
        subPanel.setAttribute('aria-hidden', 'false');
        positionNestedFlyout(trigger);
    }

    function closeNested() {
        subPanel.classList.remove('is-open');
        subPanel.setAttribute('aria-hidden', 'true');

        if (currentNestedTrigger) {
            currentNestedTrigger.classList.remove('is-nested-open');
            currentNestedTrigger.setAttribute('aria-expanded', 'false');
            currentNestedTrigger = null;
        }
    }

    function showFlyout(trigger) {
        if (!desktopQuery.matches) return;
        clearCloseTimer();

        if (!buildFlyout(trigger)) {
            closeFlyout();
            return;
        }

        if (currentTrigger && currentTrigger !== trigger) {
            currentTrigger.classList.remove('is-flyout-open');
        }

        currentTrigger = trigger;
        currentTrigger.classList.add('is-flyout-open');

        panel.classList.add('is-open');
        panel.setAttribute('aria-hidden', 'false');
        positionFlyout(trigger);
    }

    function closeFlyout() {
        clearCloseTimer();
        closeNested();

        panel.classList.remove('is-open');
        panel.setAttribute('aria-hidden', 'true');

        if (currentTrigger) {
            currentTrigger.classList.remove('is-flyout-open');
            currentTrigger = null;
        }
    }

    modules.forEach(function (trigger) {
        trigger.addEventListener('mouseenter', function () {
            showFlyout(trigger);
        });

        trigger.addEventListener('mouseleave', scheduleClose);

        trigger.addEventListener('focus', function () {
            showFlyout(trigger);
        });

        trigger.addEventListener('click', function (event) {
            if (!desktopQuery.matches) return;
            event.preventDefault();
            event.stopPropagation();
            showFlyout(trigger);
        });
    });

    panel.addEventListener('mouseover', function (event) {
        var link = event.target.closest('.izzy-flyout-link');
        if (!link || !panel.contains(link)) return;

        if (nestedSources.has(link)) {
            showNested(link);
        } else {
            closeNested();
        }
    });

    panel.addEventListener('focusin', function (event) {
        var link = event.target.closest('.izzy-flyout-link');
        if (!link || !panel.contains(link)) return;

        if (nestedSources.has(link)) {
            showNested(link);
        } else {
            closeNested();
        }
    });

    panel.addEventListener('click', function (event) {
        var link = event.target.closest('.izzy-flyout-parent');
        if (!link || !panel.contains(link)) return;

        event.preventDefault();
        event.stopPropagation();
        showNested(link);
    });

    panel.addEventListener('mouseenter', clearCloseTimer);
    panel.addEventListener('mouseleave', scheduleClose);

    subPanel.addEventListener('mouseenter', clearCloseTimer);
    subPanel.addEventListener('mouseleave', scheduleClose);
    subPanel.addEventListener('focusin', clearCloseTimer);
    subPanel.addEventListener('focusout', function (event) {
        if (!subPanel.contains(event.relatedTarget)) scheduleClose();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeFlyout();
    });

    window.addEventListener('resize', closeFlyout);
    window.addEventListener('scroll', function () {
        if (currentTrigger && panel.classList.contains('is-open')) {
            positionFlyout(currentTrigger);
        }
    }, true);

    if (typeof desktopQuery.addEventListener === 'function') {
        desktopQuery.addEventListener('change', closeFlyout);
    } else if (typeof desktopQuery.addListener === 'function') {
        desktopQuery.addListener(closeFlyout);
    }
})();
