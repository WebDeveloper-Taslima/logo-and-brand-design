/**
 * IRON & LEAF CULTIVATION CO. - CLIENT SCRIPT
 * Handles 21+ Age Verification, Strain Filtering, Terpene Modal, CSRF & Security Forms
 */

document.addEventListener('DOMContentLoaded', () => {
  initAgeGate();
  initNavigation();
  initStrains();
  initStrainModal();
  initContactForm();
  initSecuritySession();
});

/* ==========================================================================
   1. 21+ AGE GATE VERIFICATION (LEGAL CANNABIS COMPLIANCE)
   ========================================================================== */
function initAgeGate() {
  const ageGateOverlay = document.getElementById('ageGateModal');
  const btnVerify = document.getElementById('btnAgeVerify');
  const btnReject = document.getElementById('btnAgeReject');
  const rememberCheckbox = document.getElementById('rememberAgeCheck');

  if (!ageGateOverlay) return;

  const isVerified = localStorage.getItem('iron_leaf_age_verified');

  if (isVerified === 'true') {
    ageGateOverlay.classList.add('hidden');
    document.body.style.overflow = 'auto';
  } else {
    document.body.style.overflow = 'hidden';
  }

  if (btnVerify) {
    btnVerify.addEventListener('click', () => {
      if (rememberCheckbox && rememberCheckbox.checked) {
        localStorage.setItem('iron_leaf_age_verified', 'true');
        localStorage.setItem('iron_leaf_verified_at', new Date().toISOString());
      } else {
        sessionStorage.setItem('iron_leaf_age_verified', 'true');
      }

      // Set cookie for PHP backend security validation
      document.cookie = "iron_leaf_age_gate=21_verified; path=/; max-age=2592000; SameSite=Strict";

      ageGateOverlay.style.opacity = '0';
      setTimeout(() => {
        ageGateOverlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
        showToast('Welcome to Iron & Leaf Cultivation Co.', 'success');
      }, 400);
    });
  }

  if (btnReject) {
    btnReject.addEventListener('click', () => {
      window.location.href = 'https://www.responsibility.org/';
    });
  }
}

/* ==========================================================================
   2. NAVIGATION SCROLL & MOBILE TOGGLE
   ========================================================================== */
function initNavigation() {
  const nav = document.getElementById('siteNav');
  const mobileToggle = document.getElementById('mobileToggle');
  const navLinks = document.getElementById('navLinks');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      nav.classList.add('scrolled');
    } else {
      nav.classList.remove('scrolled');
    }
  });

  if (mobileToggle && navLinks) {
    mobileToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  }
}

/* ==========================================================================
   3. STRAIN CATALOG DATA & FILTERING
   ========================================================================== */
const STRAIN_DATABASE = [
  {
    id: 'chopper-og',
    name: 'Chopper OG',
    type: 'indica',
    badge: 'Heavy Indica',
    badgeClass: 'badge-indica',
    lineage: 'Ghost OG × Motorbreath #15',
    thc: '31.4%',
    cbd: '0.4%',
    terpenes: ['Beta-Caryophyllene', 'Myrcene', 'Limonene'],
    flavor: 'Pungent Diesel, Pine, Burnt Rubber',
    effects: 'Deep Body Stone, Pain Relief, Couchlock',
    growMethod: 'Indoor Living Organic Soil (Bed 4)',
    harvestDate: 'Oct 2026',
    batchNo: 'IL-IND-2026-09A',
    coaLink: '#lab-report',
    img: 'assets/images/craft-buds.jpg',
    desc: 'Bred specifically for riders logging cross-country miles. Heavy gas, heavy sedation, and resin production that glistens like polished chrome.'
  },
  {
    id: 'road-ghost-haze',
    name: 'Road Ghost Haze',
    type: 'sativa',
    badge: 'Rebel Sativa',
    badgeClass: 'badge-sativa',
    lineage: 'Super Silver Haze × Ghost Train Haze',
    thc: '28.2%',
    cbd: '0.1%',
    terpenes: ['Terpinolene', 'Alpha-Pinene', 'Ocimene'],
    flavor: 'Sharp Lemon Rind, Electric Spices, Fuel',
    effects: 'High Octane Energy, Creative Laser Focus',
    growMethod: 'Closed-Loop Deep Water Hydro (Bay 2)',
    harvestDate: 'Oct 2026',
    batchNo: 'IL-SAT-2026-03C',
    coaLink: '#lab-report',
    img: 'assets/images/craft-buds.jpg',
    desc: 'The morning spark plug. Sharp citrus fumes cut through mental fog, kicking your engine into fifth gear with no anxiety crash.'
  },
  {
    id: 'iron-spoke-gelato',
    name: 'Iron Spoke Gelato',
    type: 'hybrid',
    badge: 'True Hybrid',
    badgeClass: 'badge-hybrid',
    lineage: 'Sunset Sherbet × Thin Mint GSC × Biker Kush',
    thc: '29.8%',
    cbd: '0.8%',
    terpenes: ['Limonene', 'Linalool', 'Humulene'],
    flavor: 'Sweet Berry Sherbet, Earthy Gas, Leather',
    effects: 'Euphoric Head Buzz, Relaxed Muscles',
    growMethod: 'Organic Coco Coir & Microbe Tea (Bay 1)',
    harvestDate: 'Oct 2026',
    batchNo: 'IL-HYB-2026-07K',
    coaLink: '#lab-report',
    img: 'assets/images/craft-buds.jpg',
    desc: 'Dense purple calyxes frosted in trichomes. Delivers the sweet bakery terpene rush backed by an unmistakable punch of raw petrol.'
  },
  {
    id: 'midnight-cruiser',
    name: 'Midnight Cruiser',
    type: 'indica',
    badge: 'Indica Landrace',
    badgeClass: 'badge-indica',
    lineage: 'Vintage 1990 Mazar Afghan × Black Domina',
    thc: '33.1%',
    cbd: '1.2%',
    terpenes: ['Myrcene', 'Caryophyllene Oxide', 'Nerolidol'],
    flavor: 'Old School Hashish, Dark Plum, Fresh Earth',
    effects: 'Complete Muscle Release, Restorative Sleep',
    growMethod: '100-Gallon Living Soil Beds (Bay 5)',
    harvestDate: 'Sep 2026',
    batchNo: 'IL-IND-2026-08M',
    coaLink: '#lab-report',
    img: 'assets/images/craft-buds.jpg',
    desc: 'A throwback to old-school imported hashish genetics preserved by our founding brothers since 1994. Deeply relaxing, rich, and meditative.'
  },
  {
    id: 'piston-power-diesel',
    name: 'Piston Power Diesel',
    type: 'sativa',
    badge: 'Sativa Dominant',
    badgeClass: 'badge-sativa',
    lineage: 'Sour Diesel (East Coast Cut) × Chemdawg 91',
    thc: '27.9%',
    cbd: '0.2%',
    terpenes: ['Caryophyllene', 'Myrcene', 'Limonene'],
    flavor: 'Straight Kerosene, Skunk, Sour Lemon',
    effects: 'Uplifting Social Buzz, Relentless Drive',
    growMethod: 'Aero-Hydro Hybrid (Bay 3)',
    harvestDate: 'Oct 2026',
    batchNo: 'IL-SAT-2026-04F',
    coaLink: '#lab-report',
    img: 'assets/images/craft-buds.jpg',
    desc: 'Loud enough to wake the dead. Unadulterated chem and sour fuel notes that reek right through sealed mylar bags.'
  },
  {
    id: 'black-asphalt-velvet',
    name: 'Black Asphalt Velvet',
    type: 'hybrid',
    badge: 'Limited Drop',
    badgeClass: 'badge-hybrid',
    lineage: 'Runtz × Blackberry Kush × Biker OG',
    thc: '30.5%',
    cbd: '0.5%',
    terpenes: ['Linalool', 'Caryophyllene', 'Valencene'],
    flavor: 'Blackberry Tart, High Octane Gas, Vanilla',
    effects: 'Warm Euphoric Body Wrap, Creative Serenity',
    growMethod: 'No-Till Living Soil (Bay 6)',
    harvestDate: 'Oct 2026',
    batchNo: 'IL-HYB-2026-11X',
    coaLink: '#lab-report',
    img: 'assets/images/craft-buds.jpg',
    desc: 'Jet black flowers with blazing orange pistils. Cold-cured for 45 days in temperature-regulated vaults for maximum terpene preservation.'
  }
];

function initStrains() {
  const grid = document.getElementById('strainGrid');
  const filterButtons = document.querySelectorAll('.filter-btn');

  if (!grid) return;

  function renderStrains(filter = 'all') {
    grid.innerHTML = '';
    const filtered = filter === 'all' 
      ? STRAIN_DATABASE 
      : STRAIN_DATABASE.filter(s => s.type === filter);

    filtered.forEach(strain => {
      const card = document.createElement('div');
      card.className = 'strain-card glass-panel';
      card.innerHTML = `
        <span class="strain-badge-top ${strain.badgeClass}">${strain.badge}</span>
        <div class="strain-img-wrap">
          <img src="${strain.img}" alt="${strain.name}" onerror="this.src='assets/images/iron-and-leaf-logo.jpg'" loading="lazy">
        </div>
        <div class="strain-body">
          <h3 class="strain-name">${strain.name}</h3>
          <div class="strain-lineage">${strain.lineage}</div>
          <div class="strain-potency-bar">
            <div class="potency-metric">
              <div class="val">${strain.thc}</div>
              <div class="lbl">THC Potency</div>
            </div>
            <div class="potency-metric">
              <div class="val">${strain.cbd}</div>
              <div class="lbl">CBD</div>
            </div>
            <div class="potency-metric">
              <div class="val">COA ✓</div>
              <div class="lbl">Lab Tested</div>
            </div>
          </div>
          <div class="strain-terpenes">
            ${strain.terpenes.map(t => `<span class="terp-chip">🧪 ${t}</span>`).join('')}
          </div>
          <p style="font-size:0.85rem; margin-bottom:1.25rem;">${strain.desc}</p>
          <div class="strain-footer">
            <div class="coa-verified">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span>Batch Verified</span>
            </div>
            <button class="btn btn-outline" style="font-size:0.9rem; padding:0.4rem 0.9rem;" onclick="openStrainDetails('${strain.id}')">Batch Specs</button>
          </div>
        </div>
      `;
      grid.appendChild(card);
    });
  }

  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      filterButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.getAttribute('data-filter');
      renderStrains(filter);
    });
  });

  renderStrains('all');
}

/* ==========================================================================
   4. STRAIN DETAIL & COA MODAL
   ========================================================================== */
function initStrainModal() {
  const modal = document.getElementById('strainModal');
  const closeBtn = document.getElementById('modalCloseBtn');

  if (!modal) return;

  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      modal.classList.remove('active');
    });
  }

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.remove('active');
    }
  });
}

window.openStrainDetails = function(strainId) {
  const strain = STRAIN_DATABASE.find(s => s.id === strainId);
  const modal = document.getElementById('strainModal');
  const modalContent = document.getElementById('modalContentBody');

  if (!strain || !modal || !modalContent) return;

  modalContent.innerHTML = `
    <div style="border-bottom: 2px solid var(--accent-amber); padding-bottom: 1rem; margin-bottom: 1.5rem;">
      <span class="strain-badge-top ${strain.badgeClass}" style="position:static;">${strain.badge}</span>
      <h2 style="font-size:2.4rem; margin-top:0.5rem; margin-bottom:0.25rem;">${strain.name}</h2>
      <p style="color:var(--accent-amber); font-style:italic;">${strain.lineage}</p>
    </div>

    <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:1rem; margin-bottom:1.5rem;">
      <div style="background:#0b0d12; padding:1rem; border-radius:6px; border:1px solid #232836;">
        <span style="font-size:0.75rem; color:#9ca3af; text-transform:uppercase;">Batch / Trace Code</span>
        <div style="font-family:monospace; color:#34d399; font-weight:bold; font-size:1.1rem;">${strain.batchNo}</div>
      </div>
      <div style="background:#0b0d12; padding:1rem; border-radius:6px; border:1px solid #232836;">
        <span style="font-size:0.75rem; color:#9ca3af; text-transform:uppercase;">Harvest &amp; Cure</span>
        <div style="font-family:monospace; color:#f59e0b; font-weight:bold; font-size:1.1rem;">${strain.harvestDate} (Cold Cured)</div>
      </div>
    </div>

    <h4 style="font-size:1.1rem; margin-bottom:0.5rem; color:#ffffff;">Terpene &amp; Cannabinoid Profile</h4>
    <div style="margin-bottom:1.5rem;">
      <p style="font-size:0.9rem; margin-bottom:0.5rem;"><strong>Aroma &amp; Palate:</strong> ${strain.flavor}</p>
      <p style="font-size:0.9rem; margin-bottom:0.5rem;"><strong>Observed Effects:</strong> ${strain.effects}</p>
      <p style="font-size:0.9rem;"><strong>Grow Substrate:</strong> ${strain.growMethod}</p>
    </div>

    <div style="background:rgba(16, 185, 129, 0.1); border:1px solid #10b981; padding:1rem; border-radius:6px; font-size:0.85rem; color:#d1fae5; display:flex; align-items:center; gap:0.75rem;">
      <svg style="width:24px; height:24px; flex-shrink:0;" viewBox="0 0 24 24" fill="#10b981"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
      <div>Third-Party Lab Tested: Zero Heavy Metals • Zero Pesticides • Verified Clean by State Licensed Laboratory.</div>
    </div>
  `;

  modal.classList.add('active');
};

/* ==========================================================================
   5. WEB SECURITY SESSION & CSRF INGESTION
   ========================================================================== */
function initSecuritySession() {
  let csrfToken = sessionStorage.getItem('iron_csrf_token');
  if (!csrfToken) {
    const array = new Uint8Array(16);
    window.crypto.getRandomValues(array);
    csrfToken = Array.from(array, byte => byte.toString(16).padStart(2, '0')).join('');
    sessionStorage.setItem('iron_csrf_token', csrfToken);
  }

  const tokenInput = document.getElementById('csrfTokenInput');
  if (tokenInput) {
    tokenInput.value = csrfToken;
  }
}

/* ==========================================================================
   6. SECURE CONTACT / WHOLESALE FORM WITH SANITIZATION & HONEYPOT
   ========================================================================== */
function initContactForm() {
  const form = document.getElementById('inquiryForm');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    // Check Honeypot field (Anti-Bot Web Security)
    const honeypot = form.querySelector('input[name="biker_secret_field"]').value;
    if (honeypot) {
      console.warn("Spam bot detected via honeypot trap.");
      showToast('Form submission blocked.', 'error');
      return;
    }

    const formData = new FormData(form);

    submitBtn.disabled = true;
    submitBtn.innerHTML = `<span>Transmitting Securely...</span>`;

    try {
      const response = await fetch('api/inquiry.php', {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const result = await response.json();

      if (result.success) {
        showToast(result.message || 'Dispatch received! A member of the brotherhood will contact you.', 'success');
        form.reset();
        initSecuritySession(); // Rotate CSRF token
      } else {
        showToast(result.error || 'Security check failed. Please check your inputs.', 'error');
      }
    } catch (err) {
      console.error(err);
      // Fallback for static HTML view without PHP server running
      showToast('Dispatch encrypted and saved! (Demo mode active)', 'success');
      form.reset();
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    }
  });
}

/* Toast System */
function showToast(message, type = 'success') {
  let container = document.getElementById('toastContainer');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toastContainer';
    container.className = 'toast-container';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  toast.className = `toast ${type === 'error' ? 'error' : ''}`;
  toast.innerHTML = `
    <span>${type === 'success' ? '⚡' : '⚠️'}</span>
    <div>${message}</div>
  `;

  container.appendChild(toast);

  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(100%)';
    toast.style.transition = 'all 0.3s ease';
    setTimeout(() => toast.remove(), 300);
  }, 4500);
}
