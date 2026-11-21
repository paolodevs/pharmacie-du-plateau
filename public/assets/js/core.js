(() => {
  "use strict";

  const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
  const finePointer = window.matchMedia("(hover: hover) and (pointer: fine)");
  const desktopMotion = () => window.innerWidth >= 820 && !reducedMotion.matches;
  const motionTasks = [];
  const countups = new Set();
  let rafId = 0;
  let pointer = { x: window.innerWidth * 0.5, y: window.innerHeight * 0.5, active: false };
  let smoothPointer = { x: pointer.x, y: pointer.y };
  let scrollY = window.scrollY || 0;
  let particleScrollY = scrollY;
  let canvas;
  let canvasContext;
  let particles = [];
  let toastTimer;

  const clamp = (value, min, max) => Math.min(max, Math.max(min, value));
  const lerp = (a, b, amount) => a + (b - a) * amount;
  const config = window.SITE_CONFIG || {};

  function requestFrameLoop() {
    if (!rafId) rafId = window.requestAnimationFrame(frameLoop);
  }

  function addFrameTask(task) {
    motionTasks.push(task);
    requestFrameLoop();
    return () => {
      const index = motionTasks.indexOf(task);
      if (index >= 0) motionTasks.splice(index, 1);
    };
  }

  function frameLoop(time) {
    rafId = 0;
    smoothPointer.x = lerp(smoothPointer.x, pointer.x, 0.13);
    smoothPointer.y = lerp(smoothPointer.y, pointer.y, 0.13);
    updateCursor();
    if (desktopMotion()) {
      updateParallax();
      updateHorizontalTracks();
      drawParticles(time);
    }
    for (const task of [...motionTasks]) task(time);
    updateCountups(time);
    const needsLoop = motionTasks.length || countups.size || (desktopMotion() && (canvas || document.querySelector("[data-parallax], [data-horizontal-section]")));
    if (needsLoop) rafId = window.requestAnimationFrame(frameLoop);
  }

  function updateCursor() {
    const halo = document.querySelector(".cursor-halo");
    const dot = document.querySelector(".cursor-dot");
    if (!halo || !finePointer.matches || !desktopMotion()) return;
    halo.style.transform = `translate3d(${smoothPointer.x}px, ${smoothPointer.y}px, 0) translate(-50%, -50%)`;
    if (dot) dot.style.transform = `translate3d(${pointer.x}px, ${pointer.y}px, 0) translate(-50%, -50%)`;
  }

  function setupPointer() {
    if (!finePointer.matches) return;
    window.addEventListener("pointermove", (event) => {
      pointer.x = event.clientX;
      pointer.y = event.clientY;
      pointer.active = true;
      if (desktopMotion()) requestFrameLoop();
    }, { passive: true });
    window.addEventListener("pointerleave", () => { pointer.active = false; }, { passive: true });
    document.querySelectorAll("a, button, [data-cursor-label]").forEach((item) => {
      item.addEventListener("pointerenter", () => document.body.classList.add(item.hasAttribute("data-cursor-label") ? "cursor-view" : "cursor-hover"));
      item.addEventListener("pointerleave", () => document.body.classList.remove("cursor-view", "cursor-hover"));
    });
    window.addEventListener("pointermove", (event) => {
      const target = event.target.closest("[data-magnetic]");
      if (!target || !desktopMotion()) return;
      const rect = target.getBoundingClientRect();
      const dx = (event.clientX - rect.left - rect.width / 2) * 0.12;
      const dy = (event.clientY - rect.top - rect.height / 2) * 0.12;
      target.style.transform = `translate3d(${dx}px, ${dy}px, 0)`;
    }, { passive: true });
    document.querySelectorAll("[data-magnetic]").forEach((button) => {
      button.addEventListener("pointerleave", () => { button.style.transform = ""; });
    });
  }

  function setupCanvas() {
    canvas = document.querySelector("#ambient-canvas");
    if (!canvas) return;
    canvasContext = canvas.getContext("2d", { alpha: true });
    resizeCanvas();
    window.addEventListener("resize", resizeCanvas, { passive: true });
    const count = window.innerWidth < 820 ? 7 : 22;
    particles = Array.from({ length: count }, () => ({
      x: Math.random(), y: Math.random(), size: 1 + Math.random() * 2.4,
      drift: 0.000025 + Math.random() * 0.00006,
      sway: Math.random() * Math.PI * 2,
      leaf: Math.random() > 0.76
    }));
    requestFrameLoop();
  }

  function resizeCanvas() {
    if (!canvas || !canvasContext) return;
    const ratio = Math.min(window.devicePixelRatio || 1, 1.5);
    canvas.width = Math.round(window.innerWidth * ratio);
    canvas.height = Math.round(window.innerHeight * ratio);
    canvas.style.width = `${window.innerWidth}px`;
    canvas.style.height = `${window.innerHeight}px`;
    canvasContext.setTransform(ratio, 0, 0, ratio, 0, 0);
    if (particles.length) {
      const desired = window.innerWidth < 820 ? 7 : 22;
      particles = particles.slice(0, desired);
      while (particles.length < desired) particles.push({ x: Math.random(), y: Math.random(), size: 1.4, drift: 0.00004, sway: Math.random() * 6.28, leaf: Math.random() > 0.78 });
    }
  }

  function drawParticles(time) {
    if (!canvasContext || !canvas) return;
    const width = window.innerWidth;
    const height = window.innerHeight;
    canvasContext.clearRect(0, 0, width, height);
    const pointerX = pointer.active ? pointer.x / width : 0.5;
    const pointerY = pointer.active ? pointer.y / height : 0.5;
    const scrollDelta = clamp(scrollY - particleScrollY, -120, 120);
    particleScrollY = scrollY;
    particles.forEach((particle) => {
      particle.y -= particle.drift * 16 + scrollDelta * 0.00025;
      if (particle.y < -0.04) particle.y = 1.04;
      if (particle.y > 1.04) particle.y = -0.04;
      const x = particle.x * width + Math.sin(time * 0.00035 + particle.sway) * 12 + (pointerX - 0.5) * 14;
      const y = particle.y * height + (0.5 - pointerY) * 8;
      canvasContext.fillStyle = particle.leaf ? "rgba(21, 128, 61, .20)" : "rgba(245, 130, 32, .30)";
      if (particle.leaf) {
        canvasContext.save();
        canvasContext.translate(x, y);
        canvasContext.rotate(Math.sin(time * 0.0004 + particle.sway) * 0.55);
        canvasContext.beginPath();
        canvasContext.ellipse(0, 0, particle.size * 1.9, particle.size * 0.72, 0, 0, Math.PI * 2);
        canvasContext.fill();
        canvasContext.restore();
      } else {
        canvasContext.beginPath();
        canvasContext.arc(x, y, particle.size, 0, Math.PI * 2);
        canvasContext.fill();
      }
    });
  }

  function updateParallax() {
    const x = (smoothPointer.x / Math.max(window.innerWidth, 1) - 0.5) * 12;
    const y = (smoothPointer.y / Math.max(window.innerHeight, 1) - 0.5) * 8;
    document.querySelectorAll("[data-parallax]").forEach((layer) => {
      const factor = Number(layer.dataset.parallax) || 0.25;
      const offset = clamp(scrollY * factor * 0.08, -28, 28);
      layer.style.transform = `translate3d(${x * factor}px, ${y * factor - offset}px, 0)`;
    });
  }

  function updateHorizontalTracks() {
    document.querySelectorAll("[data-horizontal-section]").forEach((section) => {
      const track = section.querySelector("[data-horizontal-track]");
      if (!track) return;
      const maxShift = Math.max(0, track.scrollWidth - section.clientWidth + 32);
      if (!maxShift) return;
      const rect = section.getBoundingClientRect();
      const range = Math.max(1, section.offsetHeight - window.innerHeight);
      const progress = clamp((window.innerHeight - rect.top) / range, 0, 1);
      track.style.transform = `translate3d(${-progress * maxShift}px, 0, 0)`;
    });
  }

  function initReveals() {
    const elements = document.querySelectorAll(".reveal, .reveal-words, .draw-line");
    if (!("IntersectionObserver" in window) || reducedMotion.matches) {
      elements.forEach((el) => el.classList.add("is-visible"));
      return;
    }
    const observer = new IntersectionObserver((entries, currentObserver) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-visible");
        currentObserver.unobserve(entry.target);
      });
    }, { threshold: 0.16, rootMargin: "0px 0px -40px 0px" });
    elements.forEach((el) => observer.observe(el));
  }

  function splitTitles() {
    document.querySelectorAll("[data-split-title]").forEach((heading) => {
      if (heading.dataset.splitDone) return;
      const text = heading.textContent.trim();
      heading.dataset.original = text;
      let wordIndex = 0;
      const words = text.split(/(\s+)/).map((part) => {
        if (!part.trim()) return document.createTextNode(part);
        const word = document.createElement("span");
        word.className = "title-word";
        word.setAttribute("aria-hidden", "true");
        word.style.setProperty("--word-index", String(wordIndex++));
        Array.from(part).forEach((character, characterIndex) => {
          const letter = document.createElement("span");
          letter.className = "title-char";
          letter.style.setProperty("--char-index", String(characterIndex));
          letter.textContent = character;
          word.append(letter);
        });
        return word;
      });
      heading.replaceChildren(...words);
      heading.setAttribute("aria-label", text);
      heading.dataset.splitDone = "true";
      heading.classList.add("reveal-words");
    });
  }

  function initCountups() {
    document.querySelectorAll("[data-count-up]").forEach((element) => {
      const target = Number(element.dataset.countUp);
      if (!Number.isFinite(target)) return;
      if (reducedMotion.matches || !("IntersectionObserver" in window)) {
        element.textContent = String(target);
        return;
      }
      element.dataset.started = "false";
      const observer = new IntersectionObserver((entries, currentObserver) => {
        if (!entries[0].isIntersecting) return;
        element.dataset.started = "true";
        countups.add({ element, target, start: performance.now(), duration: 850 });
        requestFrameLoop();
        currentObserver.disconnect();
      }, { threshold: 0.5 });
      observer.observe(element);
    });
  }

  function updateCountups(time) {
    countups.forEach((item) => {
      const progress = clamp((time - item.start) / item.duration, 0, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      item.element.textContent = String(Math.round(item.target * eased));
      if (progress >= 1) countups.delete(item);
    });
  }

  function showToast(message, type = "success") {
    const toast = document.querySelector("#site-toast");
    if (!toast) return;
    toast.textContent = message;
    toast.className = `site-toast is-visible is-${type}`;
    window.clearTimeout(toastTimer);
    toastTimer = window.setTimeout(() => toast.classList.remove("is-visible"), 4200);
  }

  function setupForms() {
    document.querySelectorAll("form[data-demo-form]").forEach((form) => {
      form.addEventListener("submit", (event) => {
        event.preventDefault();
        if (!form.checkValidity()) {
          form.reportValidity();
          showToast("Vérifiez les champs signalés avant de continuer.", "error");
          return;
        }
        const status = form.querySelector("[data-form-status]");
        let message = "Prototype de démonstration : aucune donnée n’a été envoyée ni enregistrée.";
        if (form.matches("[data-order-form]")) message = "Démonstration seulement : aucune commande n’a été transmise. Les modalités de retrait et de paiement restent [à confirmer].";
        if (form.matches("[data-message-form]")) message = "Démonstration seulement : aucun message n’a été transmis. Ce canal n’est pas un service d’urgence.";
        if (form.matches("[data-prescription-form]")) {
          const ref = makeDemoReference();
          const output = form.querySelector("[data-demo-reference]");
          if (output) output.textContent = ref;
          message = "Démonstration seulement : aucune ordonnance n’a été téléversée ou transmise.";
        }
        if (status) status.textContent = message;
        showToast(message, "info");
        const resetAfter = form.dataset.resetAfterSubmit === "true";
        if (resetAfter) form.reset();
      });
    });

    document.querySelectorAll("input[type=file][data-demo-file]").forEach((input) => {
      input.addEventListener("change", () => {
        const file = input.files && input.files[0];
        const status = input.closest("form")?.querySelector("[data-file-status]");
        if (!file) return;
        const upload = config.uploadDemo || {};
        const allowed = upload.allowedMimeTypes || [];
        if (!allowed.includes(file.type)) {
          input.value = "";
          if (status) status.textContent = "Type de fichier non accepté dans cette démonstration. Types d'exemple à confirmer.";
          showToast("Type de fichier non accepté.", "error");
          return;
        }
        if (upload.maxBytes && file.size > upload.maxBytes) {
          input.value = "";
          if (status) status.textContent = "Fichier trop volumineux selon la limite de démonstration, à confirmer.";
          showToast("Fichier supérieur à la limite de démonstration (à confirmer).", "error");
          return;
        }
        if (status) status.textContent = `${file.name} sélectionné sur cet appareil. Aucun envoi ni enregistrement n'a lieu. ${upload.disclosure || ""}`;
      });
    });
  }

  function makeDemoReference() {
    if (window.crypto && typeof window.crypto.randomUUID === "function") return `DEMO-${window.crypto.randomUUID().toUpperCase()}`;
    return "DEMO-[référence non générée — aucune donnée transmise]";
  }

  function setupMobileNav() {
    const toggle = document.querySelector("[data-nav-toggle]");
    const nav = document.querySelector("[data-main-nav]");
    if (!toggle || !nav) return;
    toggle.addEventListener("click", () => {
      const open = toggle.getAttribute("aria-expanded") !== "true";
      toggle.setAttribute("aria-expanded", String(open));
      nav.classList.toggle("is-open", open);
      toggle.setAttribute("aria-label", open ? "Fermer le menu" : "Ouvrir le menu");
    });
    nav.querySelectorAll("a").forEach((link) => link.addEventListener("click", () => {
      toggle.setAttribute("aria-expanded", "false");
      nav.classList.remove("is-open");
    }));
  }

  function hideMissingImages() {
    document.querySelectorAll("img").forEach((img) => {
      const hide = () => img.classList.add("is-missing");
      if (img.complete && img.naturalWidth === 0) hide();
      else img.addEventListener("error", hide, { once: true });
    });
  }

  function setupTheme() {
    const saved = localStorage.getItem("plateau-theme");
    if (saved === "dark" || saved === "light") document.documentElement.dataset.theme = saved;
    document.querySelectorAll("[data-theme-toggle]").forEach((button) => {
      button.setAttribute("aria-pressed", document.documentElement.dataset.theme === "dark" ? "true" : "false");
      button.addEventListener("click", () => {
        const next = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
        document.documentElement.dataset.theme = next;
        localStorage.setItem("plateau-theme", next);
        button.setAttribute("aria-pressed", String(next === "dark"));
      });
    });
  }

  function setupRipple() {
    document.querySelectorAll(".button, button.button").forEach((button) => {
      button.addEventListener("click", (event) => {
        if (reducedMotion.matches) return;
        const rect = button.getBoundingClientRect();
        button.style.setProperty("--ripple-x", `${event.clientX - rect.left}px`);
        button.style.setProperty("--ripple-y", `${event.clientY - rect.top}px`);
        button.classList.remove("is-rippling");
        void button.offsetWidth;
        button.classList.add("is-rippling");
      });
    });
  }

  function setupTilt() {
    if (!finePointer.matches || !desktopMotion()) return;
    document.querySelectorAll("[data-tilt]").forEach((card) => {
      card.addEventListener("pointermove", (event) => {
        const rect = card.getBoundingClientRect();
        const rx = ((event.clientY - rect.top) / rect.height - 0.5) * -5;
        const ry = ((event.clientX - rect.left) / rect.width - 0.5) * 6;
        card.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-3px)`;
        card.style.setProperty("--shine-x", `${((event.clientX - rect.left) / rect.width) * 100}%`);
        card.style.setProperty("--shine-y", `${((event.clientY - rect.top) / rect.height) * 100}%`);
      }, { passive: true });
      card.addEventListener("pointerleave", () => { card.style.transform = ""; });
    });
  }

  function applyFilters(target) {
    const group = document.querySelector(target);
    if (!group) return;
    const controls = [...document.querySelectorAll("[data-filter-target]")].filter((control) => control.dataset.filterTarget === target);
    const queryControl = controls.find((control) => control.matches("[data-live-filter]"));
    const query = queryControl?.value.trim().toLocaleLowerCase("fr") || "";
    const filters = controls.filter((control) => control.matches("[data-filter-control]"));
    group.querySelectorAll("[data-filter-item]").forEach((item) => {
      const textMatches = !query || item.textContent.toLocaleLowerCase("fr").includes(query);
      const controlsMatch = filters.every((control) => !control.value || String(item.dataset[control.dataset.filterKey] || "") === String(control.value));
      item.hidden = !(textMatches && controlsMatch);
    });
  }

  function setupFilters() {
    const controls = [...document.querySelectorAll("[data-live-filter], [data-filter-control]")];
    controls.forEach((control) => {
      const target = control.dataset.filterTarget || control.dataset.liveFilter;
      if (!target) return;
      const eventName = control.matches("select, input[type='date']") ? "change" : "input";
      control.addEventListener(eventName, () => applyFilters(target));
    });
  }

  function setupAccordions() {
    document.querySelectorAll("[data-skeleton-toggle]").forEach((button) => {
      button.addEventListener("click", () => {
        const target = document.querySelector(button.dataset.skeletonToggle);
        if (!target) return;
        const active = target.classList.toggle("show-skeleton");
        button.setAttribute("aria-pressed", String(active));
        button.textContent = active ? "Masquer l’aperçu de chargement" : "Voir l’aperçu de chargement";
      });
    });
    document.querySelectorAll("[data-dismiss-banner]").forEach((button) => {
      button.addEventListener("click", () => button.closest(".notice")?.remove());
    });
    document.querySelectorAll("[data-claim-toggle]").forEach((button) => {
      button.addEventListener("click", () => {
        const state = document.querySelector(button.dataset.target);
        if (!state) return;
        state.textContent = "En cours · démo";
        state.classList.remove("badge-new");
        state.classList.add("badge-in-progress");
        button.textContent = "Pris en charge · démo";
        button.disabled = true;
        showToast("État modifié localement pour la démonstration; aucun élément n’est réservé.");
      });
    });
  }

  function getBeninNow() {
    const parts = new Intl.DateTimeFormat("en-GB", {
      timeZone: "Africa/Porto-Novo", weekday: "short", hour: "2-digit", minute: "2-digit", hourCycle: "h23"
    }).formatToParts(new Date());
    return Object.fromEntries(parts.map((part) => [part.type, part.value]));
  }

  function beninDateISO() {
    const parts = new Intl.DateTimeFormat("en-CA", { timeZone: "Africa/Porto-Novo", year: "numeric", month: "2-digit", day: "2-digit" }).formatToParts(new Date());
    const date = Object.fromEntries(parts.map((part) => [part.type, part.value]));
    return `${date.year}-${date.month}-${date.day}`;
  }

  function getRelevantClosure() {
    const today = beninDateISO();
    return (config.schedule?.exceptionalClosures || [])
      .map((item) => ({ ...item, start: item.start || item.date || "", end: item.end || item.date || "" }))
      .filter((item) => !item.end || item.end >= today)
      .sort((a, b) => (a.start || "9999").localeCompare(b.start || "9999"))[0] || null;
  }

  function getOpeningLabel() {
    const todayIso = beninDateISO();
    const closure = getRelevantClosure();
    if (closure && (!closure.start || closure.start <= todayIso) && (!closure.end || closure.end >= todayIso)) return "Fermé exceptionnellement";
    const weekly = config.schedule?.weekly || [];
    if (!weekly.length) return "Planning à confirmer";
    const now = getBeninNow();
    const days = { Mon: "lundi", Tue: "mardi", Wed: "mercredi", Thu: "jeudi", Fri: "vendredi", Sat: "samedi", Sun: "dimanche" };
    const today = days[now.weekday];
    const day = weekly.find((entry) => entry.day === today);
    if (!day || !day.intervals?.length) return "Fermé selon planning";
    const minutes = Number(now.hour) * 60 + Number(now.minute);
    const open = day.intervals.some((interval) => {
      const [start, end] = interval.split("-");
      const startMinutes = Number(start.slice(0, 2)) * 60 + Number(start.slice(3));
      const endMinutes = Number(end.slice(0, 2)) * 60 + Number(end.slice(3));
      return minutes >= startMinutes && minutes < endMinutes;
    });
    return open ? "Ouvert selon planning" : "Fermé selon planning";
  }

  function setupPlaceholders() {
    const openingLabel = getOpeningLabel();
    document.querySelectorAll("[data-opening-status]").forEach((el) => {
      el.textContent = openingLabel;
      const dot = el.closest(".chip")?.querySelector(".status-dot");
      if (dot) {
        dot.classList.toggle("is-closed", openingLabel.startsWith("Fermé"));
        dot.classList.toggle("is-unknown", openingLabel.includes("confirmer"));
      }
    });
    const closure = getRelevantClosure();
    if (closure) {
      const notice = document.createElement("div");
      notice.className = "notice notice-warning closure-notice container";
      notice.setAttribute("role", "status");
      const range = closure.start ? (closure.end && closure.end !== closure.start ? `${closure.start} — ${closure.end}` : closure.start) : "date à confirmer";
      const message = closure.message || "Une fermeture exceptionnelle est indiquée. Contactez la pharmacie pour confirmer les modalités.";
      const icon = document.createElement("span");
      icon.className = "notice-icon";
      icon.setAttribute("aria-hidden", "true");
      icon.textContent = "!";
      const text = document.createElement("p");
      const heading = document.createElement("strong");
      heading.textContent = `Fermeture exceptionnelle · ${range}. `;
      text.append(heading, document.createTextNode(message));
      notice.append(icon, text);
      const main = document.querySelector("main");
      const hero = main?.querySelector(".page-hero");
      if (main) main.insertBefore(notice, hero ? hero.nextSibling : main.firstChild);
      document.querySelectorAll("[data-closure-summary]").forEach((summary) => {
        const title = summary.querySelector("h3");
        const description = summary.querySelector("p");
        if (title) title.textContent = `Fermeture · ${range}`;
        if (description) description.textContent = message;
      });
    }
    document.querySelectorAll("[data-weekly-schedule]").forEach((table) => {
      const weekly = config.schedule?.weekly || [];
      table.querySelectorAll("tbody tr[data-weekday]").forEach((row) => {
        const day = weekly.find((entry) => String(entry.day || "").toLocaleLowerCase("fr") === row.dataset.weekday);
        const intervals = Array.isArray(day?.intervals) ? day.intervals : [];
        const cells = row.querySelectorAll("td");
        if (!cells.length) return;
        cells[0].textContent = day?.morning || (intervals[0] ? String(intervals[0]).replace("-", " – ") : (day?.closed ? "Fermé" : "[à confirmer]"));
        cells[1].textContent = day?.afternoon || (intervals[1] ? String(intervals[1]).replace("-", " – ") : (day?.closed ? "Fermé" : "[à confirmer]"));
        const badge = cells[2]?.querySelector(".badge");
        if (badge) badge.textContent = day?.status || (intervals.length || day?.morning || day?.afternoon || day?.closed ? "Horaires renseignés" : "Planning à confirmer");
      });
    });
    document.querySelectorAll("[data-duty-calendar]").forEach((list) => {
      const dates = config.schedule?.dutyCalendar || [];
      list.replaceChildren();
      if (!dates.length) {
        const item = document.createElement("li");
        item.textContent = "[à confirmer auprès de la pharmacie et de la source officielle compétente]";
        list.append(item);
      } else {
        dates.forEach((entry) => {
          const item = document.createElement("li");
          item.textContent = typeof entry === "string" ? entry : [entry.date, entry.label || entry.note].filter(Boolean).join(" · ");
          list.append(item);
        });
      }
    });
    document.querySelectorAll("[data-next-duty]").forEach((el) => {
      const date = config.schedule?.nextDutyDate;
      el.textContent = date ? new Intl.DateTimeFormat("fr-FR", { dateStyle: "long", timeZone: "Africa/Porto-Novo" }).format(new Date(`${date}T12:00:00`)) : "[à confirmer]";
    });
    document.querySelectorAll("[data-contact-value]").forEach((el) => {
      const key = el.dataset.contactValue;
      el.textContent = config.contact?.[key] || "[à confirmer]";
    });
    document.querySelectorAll("[data-last-updated]").forEach((el) => {
      const date = config.schedule?.lastUpdated;
      el.textContent = date ? new Intl.DateTimeFormat("fr-FR", { dateStyle: "long", timeZone: "Africa/Porto-Novo" }).format(new Date(`${date}T12:00:00`)) : "[à confirmer]";
    });
    document.querySelectorAll("[data-honey-field]").forEach((el) => {
      const key = el.dataset.honeyField;
      el.textContent = config.honey?.[key] || "[à confirmer]";
    });
    document.querySelectorAll("[data-current-year]").forEach((el) => el.textContent = String(new Date().getFullYear()));
  }

  function setupFloatingLabels() {
    document.querySelectorAll(".field").forEach((field) => {
      const control = field.querySelector('input:not([type="file"]):not([type="checkbox"]), select, textarea');
      if (!control || !control.id) return;
      const label = [...field.querySelectorAll("label")].find((item) => item.htmlFor === control.id);
      if (!label) return;
      field.classList.add("has-floating-label");
      const update = () => field.classList.toggle("has-value", control.tagName === "SELECT" || Boolean(control.value));
      control.addEventListener("input", update, { passive: true });
      control.addEventListener("change", update, { passive: true });
      update();
    });
  }

  function setupTransitions() {
    const overlay = document.querySelector("#page-curtain");
    if (!overlay || reducedMotion.matches) return;
    window.addEventListener("pageshow", () => {
      overlay.classList.add("is-closing");
      void overlay.offsetWidth;
      overlay.classList.remove("is-closing");
      overlay.classList.add("is-open");
      window.setTimeout(() => overlay.classList.remove("is-open"), 700);
    });
    document.querySelectorAll("a[data-transition]").forEach((link) => {
      const href = link.getAttribute("href");
      if (!href || href.startsWith("#") || link.target === "_blank" || link.hasAttribute("download")) return;
      link.addEventListener("click", (event) => {
        const url = new URL(href, location.href);
        if (url.origin !== location.origin) return;
        event.preventDefault();
        overlay.classList.add("is-closing");
        window.setTimeout(() => location.assign(url.href), 300);
      });
    });
  }

  function setupActiveNav() {
    const file = location.pathname.split("/").pop() || "index.html";
    document.querySelectorAll("[data-main-nav] a").forEach((link) => {
      const linkFile = new URL(link.href, location.href).pathname.split("/").pop();
      if (linkFile === file || (file === "" && linkFile === "index.html")) link.setAttribute("aria-current", "page");
    });
  }

  function setupPreloader() {
    const loader = document.querySelector("#preloader");
    if (!loader) return;
    let hasPlayed = false;
    try { hasPlayed = window.sessionStorage.getItem("plateau-preloader-seen") === "true"; } catch (_) {}
    if (hasPlayed) { loader.remove(); return; }
    try { window.sessionStorage.setItem("plateau-preloader-seen", "true"); } catch (_) {}
    if (reducedMotion.matches) {
      loader.classList.add("is-done");
      window.setTimeout(() => loader.remove(), 350);
      return;
    }
    window.setTimeout(() => {
      loader.classList.add("is-curtaining");
      window.setTimeout(() => {
        loader.classList.add("is-done");
        window.setTimeout(() => loader.remove(), 700);
      }, 560);
    }, 780);
  }

  function init() {
    scrollY = window.scrollY || 0;
    window.addEventListener("scroll", () => { scrollY = window.scrollY || 0; requestFrameLoop(); }, { passive: true });
    splitTitles();
    initReveals();
    initCountups();
    setupPointer();
    // setupCanvas(); // points animés en arrière-plan désactivés
    setupForms();
    setupFloatingLabels();
    setupMobileNav();
    setupTheme();
    hideMissingImages();
    setupRipple();
    setupTilt();
    setupFilters();
    setupAccordions();
    setupPlaceholders();
    setupTransitions();
    setupActiveNav();
    setupPreloader();
    document.querySelectorAll("[data-map-link]").forEach((link) => {
      if (config.contact?.mapUrl) link.href = config.contact.mapUrl;
      else { link.href = "#contact-a-confirmer"; link.addEventListener("click", () => showToast("Itinéraire à confirmer par la pharmacie.", "info")); }
    });
  }

  window.PlateauMotion = { addFrameTask, showToast, reducedMotion, desktopMotion };
  document.addEventListener("DOMContentLoaded", init);
})();
