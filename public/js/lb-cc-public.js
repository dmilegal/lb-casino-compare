(function () {
  "use strict";

  const notifier = new AWN({
    position: "bottom-left",
    labels: {
      tip: LB_CC_TRANSLATE.tip,
      info: LB_CC_TRANSLATE.info,
      success: LB_CC_TRANSLATE.success,
      attention: LB_CC_TRANSLATE.attention,
      loading: LB_CC_TRANSLATE.loading,
      error: LB_CC_TRANSLATE.error,
      cancel: LB_CC_TRANSLATE.cancel,
    },
  });

  function initInterface() {
    const selectedIds = getCurrentCompareIds();

    initToggleBtns(document);
    initBarItemRemoveBtns(document);
    initOpenBarBtns(document);
    initCloseBarBtns(document);
    initOpenCompareBtns(document);

    addCompareIdsToBtns(selectedIds);
    hideBar();
  }

  initInterface();

  /**
   * Init buttons
   */
  function initToggleBtns(container) {
    container
      .querySelectorAll(".lb-cc-toggle-btn")
      .forEach((btn) => btn.addEventListener("click", toggleCompare));
  }

  function initBarItemRemoveBtns(container) {
    container
      .querySelectorAll(".lb-cc-preview-item__remove")
      .forEach((btn) => btn.addEventListener("click", removeBarItem));
  }

  function initOpenBarBtns(container) {
    container
      .querySelectorAll(".lb-cc-bar-show")
      .forEach((btn) => btn.addEventListener("click", showBar));
  }

  function initCloseBarBtns(container) {
    container
      .querySelectorAll(".lb-cc-bar__close")
      .forEach((btn) => btn.addEventListener("click", hideBar));
  }

  function initOpenCompareBtns(container) {
    container
      .querySelectorAll(".lb-cc-bar__show-compare")
      .forEach((btn) => btn.addEventListener("click", showModal));
  }

  function removeBarItem() {
    const item = this.closest(".lb-cc-preview-item");
    removeCompareIds([item.dataset.id]);
    if (getCurrentCompareIds().length == 0) hideBar();
  }

  function toggleCompare() {
    try {
      if (this.classList.contains("lb-cc-toggle-btn--add")) {
        addCompareIds([this.dataset.id]);
        showBar();
      } else {
        removeCompareIds([this.dataset.id]);
        if (getCurrentCompareIds().length == 0) hideBar();
      }
    } catch (error) {
      LB_CC_TRANSLATE[error.message] &&
        notifier.warning(LB_CC_TRANSLATE[error.message]);
      console.error(error);
    }
  }

  function addCompareIds(ids) {
    addCompareIdsToStorage(ids);
    addCompareIdsToBtns(ids);

    return true;
  }

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function removeCompareIds(ids) {
    removeCompareIdsFromStorage(ids);
    removeCompareIdsFromBtns(ids);
    removeCompareItemFromBar(ids);

    return true;
  }

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function addCompareIdsToBtns(ids) {
    ids.forEach((id) => {
      const addBtn = document.querySelector(
        `.lb-cc-toggle-btn--add[data-id="${id}"]`
      );
      const rmBtn = document.querySelector(
        `.lb-cc-toggle-btn--remove[data-id="${id}"]`
      );
      rmBtn && rmBtn.classList.add("lb-cc-toggle-btn--active");
      addBtn && addBtn.classList.remove("lb-cc-toggle-btn--active");
    });

    return true;
  }

  async function updatePreviewList() {
    const ids = getCurrentCompareIds();
    if (!ids.length) {
      container.innerHTML = "";
      return;
    }
    const container = document.querySelector(".lb-cc-bar__list");
    container.innerHTML = "";
    const html = await loadPreviewCompares(ids);

    container.innerHTML = html;

    initBarItemRemoveBtns(document);

    return true;
  }

  async function loadPreviewCompares(ids) {
    if ("ctrl" in loadPreviewCompares) loadPreviewCompares.ctrl.abort();

    loadPreviewCompares.ctrl = new AbortController();

    const signal = loadPreviewCompares.ctrl.signal;

    try {
      const res = await fetch(
        "/wp-json/" +
          LB_CC_ROUTES.namespace +
          LB_CC_ROUTES.preview_compares +
          "?" +
          new URLSearchParams({ ids }),
        { signal }
      );
      const data = await res.json();

      return data.html;
    } catch (error) {
      return "";
    }
  }

  async function updateCompareList() {
    const ids = getCurrentCompareIds();
    if (!ids.length) {
      container.innerHTML = "";
      return;
    }
    const container = document.querySelector(".lb-cc-table");
    container.innerHTML = "";
    const html = await loadCompares(ids);

    container.innerHTML = html;
    container.style.setProperty('--lb-cc--column-count', ids.length);

    return true;
  }

  async function loadCompares(ids) {
    if ("ctrl" in loadCompares) loadCompares.ctrl.abort();

    loadCompares.ctrl = new AbortController();

    const signal = loadCompares.ctrl.signal;

    try {
      const res = await fetch(
        "/wp-json/" +
          LB_CC_ROUTES.namespace +
          LB_CC_ROUTES.table_route +
          "?" +
          new URLSearchParams({ ids }),
        { signal }
      );
      const data = await res.json();

      return data.html;
    } catch (error) {
      return "";
    }
  }

  function getCurrentCompareIds() {
    const data = localStorage.getItem(LB_CC_COOKIE_NAME);

    return data ? JSON.parse(data) : [];
  }

  function addCompareIdsToStorage(ids) {
    let currentIds = getCurrentCompareIds();
    currentIds.push(...ids);
    currentIds = [...new Set(currentIds)];

    if (currentIds.length > LB_CC_LIMIT) throw new Error("MAX_LIMIT");

    localStorage.setItem(LB_CC_COOKIE_NAME, JSON.stringify(currentIds));

    return true;
  }

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function removeCompareIdsFromStorage(ids) {
    let currentIds = getCurrentCompareIds();
    currentIds = currentIds.filter((id) => ids.indexOf(id) == -1);

    localStorage.setItem(LB_CC_COOKIE_NAME, JSON.stringify(currentIds));

    return true;
  }

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function removeCompareIdsFromBtns(ids) {
    ids.forEach((id) => {
      const addBtn = document.querySelector(
        `.lb-cc-toggle-btn--add[data-id="${id}"]`
      );
      const rmBtn = document.querySelector(
        `.lb-cc-toggle-btn--remove[data-id="${id}"]`
      );
      rmBtn && rmBtn.classList.remove("lb-cc-toggle-btn--active");
      addBtn && addBtn.classList.add("lb-cc-toggle-btn--active");
    });

    return true;
  }

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function removeCompareItemFromBar(ids) {
    ids.forEach((id) => {
      const item = document.querySelector(
        `.lb-cc-preview-item[data-id="${id}"]`
      );

      item && item.remove();
    });

    return true;
  }

  function showBar() {
    let currentIds = getCurrentCompareIds();

    const btn = document.querySelector(".lb-cc-bar-show");
    const ccBtn = document.querySelector(".lb-cc-bar__show-compare");
    const bar = document.querySelector(".lb-cc-bar");

    if (btn) btn.style.display = "none";

    if (ccBtn) ccBtn.style.display = currentIds.length > 1 ? "" : "none";

    if (bar) bar.style.display = "";

    if (currentIds.length) updatePreviewList();
  }

  function hideBar() {
    let currentIds = getCurrentCompareIds();

    const btn = document.querySelector(".lb-cc-bar-show");
    const ccBtn = document.querySelector(".lb-cc-bar__show-compare");
    const bar = document.querySelector(".lb-cc-bar");

    if (btn) btn.style.display = currentIds.length > 1 ? "" : "none";

    if (ccBtn) ccBtn.style.display = currentIds.length > 1 ? "" : "none";

    if (bar) bar.style.display = "none";
  }

  function showModal() {
    const tpl = document.querySelector(".lb-cc-modal-tpl");
    const clone = tpl.content.cloneNode(true);
    new AWN().modal(clone.firstChild.outerHTML, 'lb-cc-modal');

    updateCompareList()
  }
})();
