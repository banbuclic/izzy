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

    var currentTrigger = null;
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

    function copyIcon(source, wrapperClass) {
        var wrap = document.createElement('span');
        wrap.className = wrapperClass || '';
        var icon = source ? source.querySelector('.sb-nav-link-icon') : null;
        if (icon) {
            var iconClone = icon.cloneNode(true);
            iconClone.removeAttribute('style');
            wrap.appendChild(iconClone);
        }
        return wrap;
    }

    function itemText(link) {
        var text = link ? link.querySelector('.menu-text') : null;
        return text ? text.textContent.trim() : '';
    }

    function isHidden(link) {
        if (!link) return true;
        if (link.classList.contains('perm-hidden')) return true;
        if (link.style && link.style.display === 'none') return true;
        return false;
    }

    function renderNav(sourceNav, targetContainer, depth) {
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
                var group = document.createElement('div');
                group.className = 'izzy-flyout-group';

                var title = document.createElement('div');
                title.className = 'izzy-flyout-group-title';
                title.appendChild(copyIcon(child, ''));
                var titleText = document.createElement('span');
                titleText.textContent = itemText(child);
                title.appendChild(titleText);
                group.appendChild(title);

                var items = document.createElement('div');
                items.className = 'izzy-flyout-group-items';
                var nestedNav = next.querySelector('nav');
                var nestedCount = renderNav(nestedNav, items, (depth || 0) + 1);

                if (nestedCount > 0) {
                    group.appendChild(items);
                    targetContainer.appendChild(group);
                    added++;
                }

                i++;
                continue;
            }

            var link = cleanClone(child);
            if (!link) continue;

            link.className = 'izzy-flyout-link';
            link.setAttribute('role', 'menuitem');

            var arrow = link.querySelector('.sb-sidenav-collapse-arrow');
            if (arrow) arrow.remove();

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

        var header = document.createElement('div');
        header.className = 'izzy-sidebar-flyout-header';

        var headerIcon = document.createElement('span');
        headerIcon.className = 'izzy-sidebar-flyout-header-icon';
        var originalIcon = trigger.querySelector('.sb-nav-link-icon');
        if (originalIcon && originalIcon.firstElementChild) {
            headerIcon.appendChild(originalIcon.firstElementChild.cloneNode(true));
        }

        var copy = document.createElement('div');
        copy.className = 'izzy-sidebar-flyout-header-copy';
        var strong = document.createElement('strong');
        strong.textContent = trigger.getAttribute('data-flyout-title') || itemText(trigger);
        var small = document.createElement('span');
        small.textContent = 'Submódulos';
        copy.appendChild(strong);
        copy.appendChild(small);

        header.appendChild(headerIcon);
        header.appendChild(copy);

        var body = document.createElement('div');
        body.className = 'izzy-sidebar-flyout-body';

        var count = renderNav(sourceNav, body, 0);
        if (!count) return false;

        panel.appendChild(header);
        panel.appendChild(body);
        return true;
    }

    function positionFlyout(trigger) {
        var rect = trigger.getBoundingClientRect();
        var gap = 10;
        var viewportGap = 12;

        panel.style.left = '0px';
        panel.style.top = '0px';

        var panelRect = panel.getBoundingClientRect();
        var left = rect.right + gap;

        if (left + panelRect.width > window.innerWidth - viewportGap) {
            left = Math.max(viewportGap, rect.left - panelRect.width - gap);
        }

        var top = rect.top;
        var maxTop = Math.max(64, window.innerHeight - panelRect.height - viewportGap);
        top = Math.min(Math.max(64, top), maxTop);

        var arrowTop = Math.max(18, Math.min(panelRect.height - 24, rect.top + (rect.height / 2) - top - 7));

        panel.style.left = Math.round(left) + 'px';
        panel.style.top = Math.round(top) + 'px';
        panel.style.setProperty('--izzy-flyout-arrow-top', Math.round(arrowTop) + 'px');
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

    panel.addEventListener('mouseenter', clearCloseTimer);
    panel.addEventListener('mouseleave', scheduleClose);

    panel.addEventListener('focusin', clearCloseTimer);
    panel.addEventListener('focusout', function (event) {
        if (!panel.contains(event.relatedTarget)) scheduleClose();
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
