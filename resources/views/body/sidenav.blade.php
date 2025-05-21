  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link">
          <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">Cashier System</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">


          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">

                  <li class="nav-item">
                      <a href="{{ route('dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Home
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              Forms
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('student.batch_upload') }}" class="nav-link">
                                  <i class="fas fa-file-import nav-icon"></i>
                                  <p>Student Batch Upload</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('form.student') }}" class="nav-link">
                                  <i class="fa fa-user nav-icon"></i>
                                  <p>Student Information</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('cashier.mainform') }}" class="nav-link">
                                  <i class="fas fa-money-check-alt nav-icon"></i>
                                  <p>Cashier Form</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('forms.reports') }}" class="nav-link">
                                  <i class="fas fa-poll nav-icon"></i>
                                  <p>Reports</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fas fa-server nav-icon"></i>
                          <p>
                              Data
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('table.student') }}" class="nav-link">
                                  <i class="fas fa-money-bill-alt nav-icon"></i>
                                  <p>Cash Collection</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('data.cashdisbursement') }}" class="nav-link">
                                  <i class="fas fa-money-bill-wave nav-icon"></i>
                                  <p>Cash Disbursement</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('data.other_income') }}" class="nav-link">
                                  <i class="fas fa-cash-register nav-icon"></i>
                                  <p>Other Income</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('data.archive') }}" class="nav-link">
                                  <i class="fa fa-database nav-icon"></i>
                                  <p>Archive Data</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fas fa-cogs nav-icon"></i>
                          <p>
                              Settings
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('setting.cashier') }}" class="nav-link">
                                  <i class="fas fa-kaaba nav-icon"></i>
                                  <p>
                                      Grade Fees
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('setting.annual') }}" class="nav-link">
                                <i class="fas fa-people-carry nav-icon"></i>
                                <p>
                                    Annual Fees
                                </p>
                            </a>
                        </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fas fa-users-cog nav-icon"></i>
                          <p>
                              About Us
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('about.developer') }}" class="nav-link">
                                  <i class="fas fa-users nav-icon"></i>
                                  <p>Developers Information</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('about.system') }}" class="nav-link">
                                  <i class="fas fa-tools nav-icon"></i>
                                  <p>System Information</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('logout') }}"
                          role="button"
                          onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                          <i class="nav-icon fas fa-power-off"></i>
                          <p> Logout</p>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </li>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
