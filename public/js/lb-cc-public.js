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

  initToggleBtns(document);
  initBarItemRemoveBtns(document);
  initOpenBarBtns(document);
  initCloseBarBtns(document);
  initOpenCompareBtns(document);

  function removeBarItem() {
    const item = this.closest(".lb-cc-preview-item");
    removeCompareIds([item.dataset.id]);
  }

  function toggleCompare() {
    try {
      if (this.classList.contains("lb-cc-toggle-btn--add")) {
        addCompareIds([this.dataset.id]);
      } else {
        removeCompareIds([this.dataset.id]);
      }
    } catch (error) {
      LB_CC_TRANSLATE[error.message] &&
        notifier.warning(LB_CC_TRANSLATE[error.message]);
      console.error(error);
    }
  }

  function getCurrentCompareIds() {
    const data = document.cookie.split("; ").reduce((acc, item) => {
      const [name, value] = item.split("=");
      acc[name] = value;
      return acc;
    }, {});
    return data[LB_CC_COOKIE_NAME] ? data[LB_CC_COOKIE_NAME].split(",") : [];
  }

  function addCompareIds(ids) {
    addCompareIdsToCookie(ids);
    addCompareIdsToBtns(ids);
    addCompareItemToBar(ids);
    toggleBar();

    return true;
  }

  function addCompareIdsToCookie(ids) {
    let currentIds = getCurrentCompareIds();
    currentIds.push(...ids);
    currentIds = [...new Set(currentIds)];

    if (currentIds.length > LB_CC_LIMIT) throw new Error("MAX_LIMIT");

    document.cookie = `${LB_CC_COOKIE_NAME}=${currentIds.join(",")}`;

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

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function addCompareItemToBar(ids) {
    ids.forEach((id) => {
      const btn = document.querySelector(
        `.lb-cc-toggle-btn--add[data-id="${id}"]`
      );
      const container = document.querySelector(".lb-cc-bar__list");

      const div = document.createElement("div");
      div.classList.add("lb-cc-preview-item");
      div.dataset.id = id;
      div.innerHTML = `<button class="lb-cc-preview-item__remove" title="remove item">
              <i class="fas fa-times" aria-hidden="true"></i>
          </button>
          <img width="85" height="85" src="${btn.dataset.src}">
          <div class="lb-cc-preview-item__title">${btn.dataset.title}</div>`;

      initBarItemRemoveBtns(div);

      container.appendChild(div);
    });

    return true;
  }

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function removeCompareIds(ids) {
    removeCompareIdsFromCookie(ids);
    removeCompareIdsFromBtns(ids);
    removeCompareItemFromBar(ids);

    if (getCurrentCompareIds().length < 2) hideBar();

    return true;
  }

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function removeCompareIdsFromCookie(ids) {
    let currentIds = getCurrentCompareIds();
    currentIds = currentIds.filter((id) => ids.indexOf(id) == -1);

    document.cookie = `${LB_CC_COOKIE_NAME}=${currentIds.join(",")}`;

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

  function toggleBar() {
    let currentIds = getCurrentCompareIds();

    if (currentIds.length > 1) showBar();
    else hideBar();
  }

  function showBar() {
    const btn = document.querySelector(".lb-cc-bar-show");
    const bar = document.querySelector(".lb-cc-bar");

    if (btn) btn.style.display = "none";

    if (bar) bar.style.display = "";
  }

  function hideBar() {
    let currentIds = getCurrentCompareIds();

    const btn = document.querySelector(".lb-cc-bar-show");
    const bar = document.querySelector(".lb-cc-bar");

    if (btn) btn.style.display = currentIds.length > 1 ? "" : "none";

    if (bar) bar.style.display = "none";
  }

  function showModal() {
    const tpl = document.querySelector('.lb-cc-modal-tpl');
    const clone = tpl.content.cloneNode(true);
    new AWN().modal(clone.firstChild.outerHTML)
  }
})();
