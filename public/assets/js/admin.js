/* Espace de gestion — comportements du gabarit et du tableau de bord (démonstration). */
(function () {
  "use strict";

  var config = window.SITE_CONFIG || {};

  function toast(message, type) {
    var el = document.querySelector("#site-toast");
    if (!el) return;
    el.textContent = message;
    el.className = "site-toast is-visible is-" + (type || "info");
    window.clearTimeout(toast.timer);
    toast.timer = window.setTimeout(function () { el.classList.remove("is-visible"); }, 4200);
  }

  /* Menu latéral sur petits écrans */
  function setupShell() {
    var app = document.querySelector("[data-app]");
    var toggle = document.querySelector("[data-app-menu]");
    if (!app || !toggle) return;
    var sidebar = document.querySelector("#adm-sidebar");
    function setOpen(open) {
      app.classList.toggle("sidebar-open", open);
      toggle.setAttribute("aria-expanded", String(open));
      toggle.setAttribute("aria-label", open ? "Fermer la navigation" : "Ouvrir la navigation");
      if (open && sidebar) { var first = sidebar.querySelector("a"); if (first) first.focus(); }
    }
    toggle.addEventListener("click", function () { setOpen(!app.classList.contains("sidebar-open")); });
    var scrim = document.querySelector("[data-app-scrim]");
    if (scrim) scrim.addEventListener("click", function () { setOpen(false); });
    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape" && app.classList.contains("sidebar-open")) { setOpen(false); toggle.focus(); }
    });
  }

  /* État affiché sur le site : sélection + publication (démonstration) */
  function setupState() {
    var card = document.querySelector("[data-state-card]");
    if (!card) return;
    var now = card.querySelector("[data-state-now]");
    function sync() {
      var checked = card.querySelector("input[name='site-state']:checked");
      if (!checked) return;
      card.dataset.state = checked.value;
      var label = card.querySelector("label[for='" + checked.id + "']");
      if (now && label) now.textContent = label.textContent;
    }
    card.addEventListener("change", sync);
    sync();
    var publish = card.querySelector("[data-state-publish]");
    if (publish) publish.addEventListener("click", function () {
      toast("Démonstration : l’état « " + (now ? now.textContent : "") + " » n’est pas publié sur le site. Un serveur est nécessaire.", "info");
    });
  }

  /* Filtres du tableau : compteur, état vide, réinitialisation */
  function setupTableFilters() {
    document.querySelectorAll("[data-result-count]").forEach(function (counter) {
      var selector = counter.getAttribute("data-result-count");
      var table = document.querySelector(selector);
      if (!table) return;
      var empty = table.querySelector("[data-filter-empty]");
      function refresh() {
        var items = Array.prototype.slice.call(table.querySelectorAll("[data-filter-item]"));
        var visible = items.filter(function (row) { return !row.hidden; }).length;
        counter.textContent = visible + (visible > 1 ? " éléments" : " élément");
        if (empty) empty.hidden = visible !== 0;
      }
      document.querySelectorAll("[data-filter-target='" + selector + "']").forEach(function (control) {
        control.addEventListener(control.matches("select") ? "change" : "input", function () { window.setTimeout(refresh, 0); });
      });
      document.querySelectorAll("[data-filter-reset='" + selector + "']").forEach(function (button) {
        button.addEventListener("click", function () {
          document.querySelectorAll("[data-filter-target='" + selector + "']").forEach(function (control) {
            control.value = "";
            control.dispatchEvent(new Event("change", { bubbles: true }));
          });
        });
      });
      refresh();
    });
  }

  /* Prochaines gardes : lues depuis config.js dès qu'elles sont renseignées */
  function setupDuty() {
    var list = document.querySelector("[data-duty-list]");
    var calendar = config.schedule && config.schedule.dutyCalendar;
    if (!list || !calendar || !calendar.length) return;
    list.textContent = "";
    calendar.slice(0, 4).forEach(function (entry) {
      var date = typeof entry === "string" ? entry : entry.date;
      var label = typeof entry === "string" ? "Garde" : (entry.label || "Garde");
      var li = document.createElement("li");
      var strong = document.createElement("strong");
      var parsed = /^\d{4}-\d{2}-\d{2}$/.test(date) ? new Date(date + "T12:00:00") : null;
      strong.textContent = parsed ? parsed.toLocaleDateString("fr-FR", { weekday: "long", day: "numeric", month: "long" }) : date;
      li.appendChild(strong);
      li.appendChild(document.createTextNode(label));
      list.appendChild(li);
    });
  }

  function init() { setupShell(); setupState(); setupTableFilters(); setupDuty(); }
  if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", init); else init();
})();
