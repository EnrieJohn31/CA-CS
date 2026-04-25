@extends('home.index')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

    <section class="content" style="padding-top:0;">
    <div class="container-fluid pt-3 pb-4">

    {{-- Hero --}}
    <div class="pg-hero" style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 55%,#06b6d4 100%);margin-bottom:20px;">
        <div class="pg-hero__eyebrow"><i class="fas fa-calendar-alt"></i> Settings · Annual Fees</div>
        <div class="pg-hero__title">Annual Fees</div>
        <div class="pg-hero__sub">Set the annual fee amounts applied across all grade levels</div>
    </div>

    <style>
        /* ---- Fee category cards ---- */
        .fee-category-card {
            background: var(--ct-surface);
            border: 1px solid var(--ct-border);
            border-radius: var(--ct-radius);
            box-shadow: var(--ct-shadow);
            overflow: hidden;
            transition: box-shadow var(--ct-transition);
            height: 100%;
        }
        .fee-category-card:hover { box-shadow: var(--ct-shadow-lg); }

        .fee-category-card__header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--ct-border);
        }
        .fee-category-card__icon {
            width: 38px; height: 38px;
            border-radius: var(--ct-radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .fee-category-card__title {
            font-size: .82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--ct-text);
            margin: 0;
        }
        .fee-category-card__subtitle {
            font-size: .75rem;
            color: var(--ct-text-muted);
            margin: 2px 0 0;
        }
        .fee-category-card__body { padding: 16px 18px; }

        /* ---- Individual fee row ---- */
        .fee-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid var(--ct-border);
        }
        .fee-row:last-child { border-bottom: none; padding-bottom: 0; }
        .fee-row:first-child { padding-top: 0; }

        .fee-row__label {
            flex: 1;
            font-size: .88rem;
            font-weight: 500;
            color: var(--ct-text);
            min-width: 0;
        }
        .fee-row__label small {
            display: block;
            font-size: .73rem;
            color: var(--ct-text-muted);
            font-weight: 400;
            margin-top: 1px;
        }
        .fee-row__input-wrap {
            flex: 0 0 150px;
        }
        .fee-row__input-wrap .input-group-text {
            font-weight: 600;
            font-size: .85rem;
            min-width: 36px;
            justify-content: center;
        }
        .fee-row__input-wrap .form-control {
            font-variant-numeric: tabular-nums;
            font-weight: 500;
            text-align: right;
            padding-right: 10px;
        }

        /* ---- Color variants for icon backgrounds ---- */
        .icon-health   { background: rgba(239,68,68,.12);  color: #ef4444; }
        .icon-academic { background: rgba(79,70,229,.12);  color: #4f46e5; }
        .icon-services { background: rgba(6,182,212,.12);  color: #06b6d4; }
        .icon-special  { background: rgba(245,158,11,.14); color: #f59e0b; }

        /* ---- Sticky save bar ---- */
        .annual-fee-save-bar {
            position: sticky;
            bottom: 0;
            z-index: 50;
            background: var(--ct-surface);
            border-top: 1px solid var(--ct-border);
            padding: 14px 0;
            margin-top: 24px;
            box-shadow: 0 -4px 16px rgba(0,0,0,.08);
        }
        .annual-fee-save-bar .container-fluid { display: flex; align-items: center; justify-content: flex-end; gap: 10px; }

        /* ---- Summary total badge ---- */
        .annual-total-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--ct-surface-alt);
            border: 1px solid var(--ct-border);
            border-radius: var(--ct-radius-sm);
            padding: 8px 16px;
            font-size: .88rem;
            font-weight: 600;
            color: var(--ct-text);
        }
        .annual-total-badge span { color: var(--ct-primary); font-size: 1rem; }
    </style>

            <form id="annual-fee-form" novalidate>
                @csrf

                <div class="row g-3">

                    {{-- ── Health & Safety ── --}}
                    <div class="col-lg-6 col-xl-4 mb-3">
                        <div class="fee-category-card">
                            <div class="fee-category-card__header">
                                <div class="fee-category-card__icon icon-health">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div>
                                    <div class="fee-category-card__title">Health &amp; Safety</div>
                                    <div class="fee-category-card__subtitle">Annual medical coverage fees</div>
                                </div>
                            </div>
                            <div class="fee-category-card__body">

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Medical Fee
                                        <small>Annual health check &amp; clinic services</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Medical" name="Medical"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Insurance Fee
                                        <small>Student accident insurance coverage</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Insurance" name="Insurance"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Death Aid Fee
                                        <small>Sudden death benefit contribution</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Death" name="Death"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Dental Fee
                                        <small>Annual dental care services</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Dental" name="Dental"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ── Academic Resources ── --}}
                    <div class="col-lg-6 col-xl-4 mb-3">
                        <div class="fee-category-card">
                            <div class="fee-category-card__header">
                                <div class="fee-category-card__icon icon-academic">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div>
                                    <div class="fee-category-card__title">Academic Resources</div>
                                    <div class="fee-category-card__subtitle">Library, books &amp; laboratory access</div>
                                </div>
                            </div>
                            <div class="fee-category-card__body">

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Library Fee
                                        <small>Library access &amp; maintenance</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Library" name="Library"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Book Fee
                                        <small>Instructional materials &amp; textbooks</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Book" name="Book"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Laboratory Fee
                                        <small>Science &amp; computer lab usage</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Laboratory" name="Laboratory"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        School Publication
                                        <small>School paper &amp; media publications</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="School_Pub" name="School_Pub"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ── Student Services ── --}}
                    <div class="col-lg-6 col-xl-4 mb-3">
                        <div class="fee-category-card">
                            <div class="fee-category-card__header">
                                <div class="fee-category-card__icon icon-services">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <div class="fee-category-card__title">Student Services</div>
                                    <div class="fee-category-card__subtitle">IDs, records &amp; activity fees</div>
                                </div>
                            </div>
                            <div class="fee-category-card__body">

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Athlete Fee
                                        <small>Sports program participation</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Athlet" name="Athlet"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        BACS Fee
                                        <small>Barangay Academic Civic Services</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="BACS" name="BACS"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Student ID Fee
                                        <small>ID card production &amp; replacement</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="StudentID" name="StudentID"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Passbook Fee
                                        <small>Student passbook issuance</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Passbook" name="Passbook"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Handbook Fee
                                        <small>Student handbook &amp; planner</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Handbook" name="Handbook"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ── Special / Milestone Fees ── --}}
                    <div class="col-lg-6 col-xl-4 mb-3">
                        <div class="fee-category-card">
                            <div class="fee-category-card__header">
                                <div class="fee-category-card__icon icon-special">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <div class="fee-category-card__title">Milestone Fees</div>
                                    <div class="fee-category-card__subtitle">Completion &amp; graduation related</div>
                                </div>
                            </div>
                            <div class="fee-category-card__body">

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Completers Fee
                                        <small>End-of-level completion requirement</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="Completers_Fee" name="Completers_Fee"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-row">
                                    <div class="fee-row__label">
                                        Graduation Fee
                                        <small>Ceremony, diploma &amp; memorabilia</small>
                                    </div>
                                    <div class="fee-row__input-wrap">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   class="form-control" id="graduation" name="graduation"
                                                   placeholder="0.00" oninput="updateTotal()">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>{{-- /.row --}}

                {{-- ── Sticky Save Bar ── --}}
                <div class="annual-fee-save-bar">
                    <div class="container-fluid">
                        <div class="annual-total-badge mr-auto">
                            <i class="fas fa-calculator"></i>
                            Total Annual Fees: <span id="grandTotal">₱ 0.00</span>
                        </div>
                        <button type="button" class="btn btn-outline-secondary" id="resetFeeBtn">
                            <i class="fas fa-undo mr-1"></i> Reset
                        </button>
                        <button type="button" class="btn btn-primary px-4" id="payadbleForm">
                            <i class="fas fa-save mr-2"></i> Save Annual Fees
                        </button>
                    </div>
                </div>

            </form>

    <script>
        function updateTotal() {
            var total = 0;
            document.querySelectorAll('#annual-fee-form input[type="number"]').forEach(function (input) {
                var val = parseFloat(input.value);
                if (!isNaN(val) && val > 0) total += val;
            });
            document.getElementById('grandTotal').textContent = '₱ ' + total.toLocaleString('en-PH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        document.getElementById('resetFeeBtn').addEventListener('click', function () {
            document.querySelectorAll('#annual-fee-form input[type="number"]').forEach(function (input) {
                input.value = '';
            });
            updateTotal();
        });

        // Number-only validation (allows decimals)
        document.querySelectorAll('#annual-fee-form input[type="number"]').forEach(function (input) {
            input.addEventListener('keypress', function (e) {
                if (!/[\d.]/.test(e.key)) e.preventDefault();
            });
            input.addEventListener('blur', function () {
                if (this.value !== '' && !isNaN(parseFloat(this.value))) {
                    this.value = parseFloat(this.value).toFixed(2);
                    updateTotal();
                }
            });
        });
    </script>

    </div>{{-- /.container-fluid --}}
    </section>
@endsection
