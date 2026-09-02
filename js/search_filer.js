(function (global) {
    "use strict";

    /* ===== 注入全局样式 ===== */
    function injectStyles() {
        if (document.getElementById('reinput-dynamic-css')) return;
        var style = document.createElement('style');
        style.id = 'reinput-dynamic-css';
        style.textContent = [
            '.ri-wrapper { position: relative; }',
            '.ri-input {',
            '  border-radius: 8px !important;',
            '  border: 1.5px solid #e9ecef !important;',
            '  padding: 0.6rem 0.9rem !important;',
            '  font-size: 0.9rem !important;',
            '  transition: all 0.2s !important;',
            '  color: #32325d !important;',
            '  background: #fff !important;',
            '}',
            '.ri-input:focus {',
            '  border-color: #418679 !important;',
            '  box-shadow: 0 0 0 3px rgba(65,134,121,0.1) !important;',
            '  outline: none !important;',
            '}',
            '.ri-dropdown {',
            '  position: absolute;',
            '  left: 0; right: 0;',
            '  background: #fff;',
            '  border: 1px solid #e0e7e4;',
            '  border-radius: 10px;',
            '  box-shadow: 0 8px 30px rgba(0,0,0,0.10);',
            '  z-index: 1050;',
            '  max-height: 220px;',
            '  overflow-y: auto;',
            '  overflow-x: hidden;',
            '  animation: riFadeIn 0.18s ease;',
            '  margin-top: 4px;',
            '}',
            '@keyframes riFadeIn {',
            '  from { opacity: 0; transform: translateY(-6px); }',
            '  to   { opacity: 1; transform: translateY(0); }',
            '}',
            '.ri-item {',
            '  display: block;',
            '  padding: 0.55rem 1rem;',
            '  font-size: 0.88rem;',
            '  color: #525f7f;',
            '  cursor: pointer;',
            '  transition: all 0.12s;',
            '  border-bottom: 1px solid #f5f7f6;',
            '  white-space: nowrap;',
            '  overflow: hidden;',
            '  text-overflow: ellipsis;',
            '}',
            '.ri-item:last-child { border-bottom: none; }',
            '.ri-item:hover {',
            '  background: #f2f7f5;',
            '  color: #1a3c34;',
            '  padding-left: 1.2rem;',
            '}',
            '.ri-item mark {',
            '  background: rgba(65,134,121,0.15);',
            '  color: #1a3c34;',
            '  padding: 0 2px;',
            '  border-radius: 2px;',
            '  font-weight: 600;',
            '}',
            '.ri-no-results {',
            '  padding: 1rem;',
            '  text-align: center;',
            '  color: #8898aa;',
            '  font-size: 0.85rem;',
            '}',
            '.ri-dropdown::-webkit-scrollbar { width: 5px; }',
            '.ri-dropdown::-webkit-scrollbar-track { background: transparent; }',
            '.ri-dropdown::-webkit-scrollbar-thumb { background: #dde8e4; border-radius: 10px; }',
        ].join('\n');
        document.head.appendChild(style);
    }

    var plugin = {
        name: null,
        target: null,
        data: null,
        ipt: null,
        dsearch: null,
        ajax: {
            url: null,
            type: 'POST',
            dataType: 'JSON',
            async: false,
            data: null
        },
        api: { change: function () {} }
    };

    function escapeHTML(str) {
        var div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function highlightMatch(text, query) {
        if (!query) return escapeHTML(text);
        var escaped = escapeHTML(text);
        var q = escapeHTML(query).replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        return escaped.replace(new RegExp('(' + q + ')', 'gi'), '<mark>$1</mark>');
    }

    function init(plugin) {
        injectStyles();

        plugin.target = document.querySelector(plugin.target);
        plugin.target.innerHTML = '';
        plugin.target.classList.add('ri-wrapper');

        $('<input>', {
            'type': 'text',
            'id': plugin.name + '_ipt',
            'name': plugin.name,
            'class': 'form-control ri-input',
            'autocomplete': 'off',
            'placeholder': 'Type to search...'
        }).appendTo(plugin.target);

        $('<div>', { 'id': plugin.name + '_divsearch' }).appendTo(plugin.target);

        plugin.ipt = document.getElementById(plugin.name + '_ipt');
        plugin.dsearch = document.getElementById(plugin.name + '_divsearch');

        var fun = {
            on: function (doc, e, fn) {
                doc.addEventListener ? doc.addEventListener(e, fn, false) : doc.attachEvent('on' + e, fn);
            },
            un: function (doc, e, fn) {
                doc.removeEventListener ? doc.removeEventListener(e, fn, false) : doc.detachEvent('on' + e, fn);
            },
            list: function (inputEl) {
                return function () {
                    var query = inputEl.value.trim();
                    var items = [];
                    var total = plugin.data.length;

                    var filtered = plugin.data;
                    if (query) {
                        filtered = plugin.data.filter(function (item) {
                            return item.label.toUpperCase().indexOf(query.toUpperCase()) !== -1;
                        });
                    }

                    if (filtered.length === 0 && query) {
                        plugin.dsearch.innerHTML =
                            '<div class="ri-dropdown">' +
                            '<div class="ri-no-results">No matches found</div>' +
                            '</div>';
                        return;
                    }

                    var scrollClass = filtered.length > 6 ? '' : '';
                    var html = '<div class="ri-dropdown">';
                    for (var i = 0; i < filtered.length; i++) {
                        var label = highlightMatch(filtered[i].label, query);
                        html += '<a class="ri-item">' + label + '</a>';
                    }
                    html += '</div>';
                    plugin.dsearch.innerHTML = html;
                };
            },
            mouseleave: function (el) {
                return function () {
                    plugin.api.change();
                    el.innerHTML = '';
                };
            },
            inputJoinValue: function (inputEl, dropdownEl) {
                return function (e) {
                    var target = e.target;
                    if (!target.classList.contains('ri-item')) return;
                    // Extract plain text (strip <mark> tags)
                    inputEl.value = target.textContent;
                    dropdownEl.innerHTML = '';
                    plugin.api.change();
                };
            }
        };

        var closeTimer = null;

        fun.on(plugin.ipt, 'focus', fun.list(plugin.ipt));
        fun.on(plugin.ipt, 'input', fun.list(plugin.ipt));

        // mouseleave 加延迟防止误关
        fun.on(plugin.target, 'mouseleave', function () {
            closeTimer = setTimeout(function () {
                plugin.dsearch.innerHTML = '';
                plugin.api.change();
            }, 200);
        });
        fun.on(plugin.target, 'mouseenter', function () {
            if (closeTimer) clearTimeout(closeTimer);
        });

        // 点击外部关闭
        fun.on(document, 'mousedown', function (e) {
            if (!plugin.target.contains(e.target)) {
                plugin.dsearch.innerHTML = '';
            }
        });

        fun.on(plugin.dsearch, 'mousedown', fun.inputJoinValue(plugin.ipt, plugin.dsearch));

        // 键盘导航
        fun.on(plugin.ipt, 'keydown', function (e) {
            var items = plugin.dsearch.querySelectorAll('.ri-item');
            if (!items.length) return;
            var cur = plugin.dsearch.querySelector('.ri-item.ri-active');

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (!cur) { items[0].classList.add('ri-active'); items[0].scrollIntoView({ block: 'nearest' }); return; }
                cur.classList.remove('ri-active');
                var next = cur.nextElementSibling || items[0];
                next.classList.add('ri-active');
                next.scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (!cur) { items[items.length - 1].classList.add('ri-active'); return; }
                cur.classList.remove('ri-active');
                var prev = cur.previousElementSibling || items[items.length - 1];
                prev.classList.add('ri-active');
                prev.scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (cur) {
                    plugin.ipt.value = cur.textContent;
                    plugin.dsearch.innerHTML = '';
                    plugin.api.change();
                }
            } else if (e.key === 'Escape') {
                plugin.dsearch.innerHTML = '';
            }
        });
    }

    function reinput(plu) {
        var plugin_copy = JSON.parse(JSON.stringify(plugin));
        this.plugin_copy = (function (plu) {
            if (!plu) return plugin_copy;
            Object.keys(plu).forEach(function (key) {
                if (typeof plu[key] === 'object') {
                    Object.keys(plu[key]).forEach(function (key1) {
                        plugin_copy[key][key1] = plu[key][key1];
                    });
                } else {
                    plugin_copy[key] = plu[key];
                }
            });
            return plugin_copy;
        })(plu);

        if (!this.plugin_copy.data) {
            $.ajax({
                url: this.plugin_copy.ajax.url,
                type: this.plugin_copy.ajax.type,
                dataType: this.plugin_copy.ajax.dataType,
                async: this.plugin_copy.ajax.async,
                data: this.plugin_copy.ajax.data,
                success: function (data) {
                    this.plugin_copy.data = data.filter(function (row) { return row.label; });
                    init(this.plugin_copy);
                }.bind(this)
            });
        }

        this.val = function (val, update_list) {
            var self = this;
            self.plugin_copy.ipt.value = val;
            var data = update_list.map(function (e) {
                return '"' + e.plugin_copy.name + '":"' + e.plugin_copy.ipt.value + '"';
            });
            update_list.forEach(function (e) {
                if (e.plugin_copy.name !== self.plugin_copy.name)
                    e.updateAjax(JSON.parse('{' + data.join(',') + '}'));
            });
        };

        this.change = function (update_list) {
            var self = this;
            var data = update_list.map(function (e) {
                return '"' + e.plugin_copy.name + '":"' + e.plugin_copy.ipt.value + '"';
            });
            update_list.forEach(function (e) {
                if (e.plugin_copy.name !== self.plugin_copy.name)
                    e.updateAjax(JSON.parse('{' + data.join(',') + '}'));
            });
        };

        this.reset = function (update_list) {
            update_list.forEach(function (e) {
                e.updateAjax({});
                e.plugin_copy.ipt.value = '';
            });
        };

        this.update = function (data) {
            this.plugin_copy.data = data.filter(function (row) { return row.label; });
        };

        this.updateAjax = function (data) {
            var self = this;
            self.plugin_copy.data = [{ 'label': 'Loading…' }];
            $.ajax({
                url: self.plugin_copy.ajax.url,
                type: self.plugin_copy.ajax.type,
                dataType: self.plugin_copy.ajax.dataType,
                data: data,
                success: function (data) {
                    self.plugin_copy.data = data.filter(function (row) { return row.label; });
                }
            });
        };
    }

    global.reinput = reinput;
})(window);
