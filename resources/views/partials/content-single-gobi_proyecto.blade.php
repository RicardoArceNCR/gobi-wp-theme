@php
  $postId = get_the_ID();

  $expediente = get_post_meta($postId, '_gobi_expediente', true);
  $estado = get_post_meta($postId, '_gobi_estado', true) ?: 'presentado';
  $paisId = get_post_meta($postId, '_gobi_pais_id', true);
  $fechaInicio = get_post_meta($postId, '_gobi_fecha_inicio', true);
  $resumen = get_post_meta($postId, '_gobi_resumen_ciudadano', true);
  $textoBaseUrl = get_post_meta($postId, '_gobi_texto_base_url', true);
  $organoPresentador = get_post_meta($postId, '_gobi_organo_presentador', true);
  $comisionId = get_post_meta($postId, '_gobi_comision_id', true);

  $pais = $paisId ? get_the_title($paisId) : '';
  $comision = $comisionId ? get_the_title($comisionId) : '';
  $temas = get_the_terms($postId, 'gobi_tema');
@endphp

<article @php(post_class('gobi-project'))>
  <header class="gobi-project-header">
    <div class="gobi-container gobi-project-header__container">
      <div class="gobi-project-header__content">
        <p class="gobi-badge">Proyecto legislativo</p>

        <h1 class="gobi-project-header__title">
          {!! get_the_title() !!}
        </h1>

        @if($resumen)
          <p class="gobi-project-header__subtitle">
            {{ $resumen }}
          </p>
        @endif

        <div class="gobi-project-header__meta">
          @if($expediente)
            <span class="gobi-badge">Expediente {{ $expediente }}</span>
          @endif

          <span class="gobi-badge">{{ ucfirst(str_replace('_', ' ', $estado)) }}</span>

          @if($pais)
            <span class="gobi-badge">{{ $pais }}</span>
          @endif
        </div>
      </div>
    </div>
  </header>

  <section class="gobi-project-content">
    <div class="gobi-container gobi-project-content__container">
      <main class="gobi-project-main">
        <section class="gobi-project-section">
          <h2 class="gobi-project-section__title">Resumen ciudadano</h2>
          <div class="gobi-project-section__content">
            @if($resumen)
              <p>{{ $resumen }}</p>
            @else
              <p>Este proyecto todavía no tiene resumen ciudadano.</p>
            @endif
          </div>
        </section>

        <section class="gobi-project-section">
          <h2 class="gobi-project-section__title">Descripción oficial</h2>
          <div class="gobi-project-section__content">
            @php(the_content())
          </div>
        </section>

        @if($textoBaseUrl)
          <section class="gobi-project-section">
            <h2 class="gobi-project-section__title">Documento base</h2>
            <div class="gobi-project-documents__list">
              <a class="gobi-project-document" href="{{ esc_url($textoBaseUrl) }}" target="_blank" rel="noopener noreferrer">
                <div class="gobi-project-document__info">
                  <div class="gobi-project-document__title">Ver texto base oficial</div>
                  <div class="gobi-project-document__meta">{{ $textoBaseUrl }}</div>
                </div>
              </a>
            </div>
          </section>
        @endif
      </main>

      <aside class="gobi-project-sidebar">
        @if($expediente)
          <div class="gobi-project-sidebar__section">
            <h2 class="gobi-project-sidebar__title">Expediente</h2>
            <div class="gobi-project-sidebar__content">{{ $expediente }}</div>
          </div>
        @endif

        <div class="gobi-project-sidebar__section">
          <h2 class="gobi-project-sidebar__title">Estado</h2>
          <div class="gobi-project-sidebar__content">{{ ucfirst(str_replace('_', ' ', $estado)) }}</div>
        </div>

        @if($fechaInicio)
          <div class="gobi-project-sidebar__section">
            <h2 class="gobi-project-sidebar__title">Fecha de inicio</h2>
            <div class="gobi-project-sidebar__content">{{ $fechaInicio }}</div>
          </div>
        @endif

        @if($pais)
          <div class="gobi-project-sidebar__section">
            <h2 class="gobi-project-sidebar__title">País</h2>
            <div class="gobi-project-sidebar__content">{{ $pais }}</div>
          </div>
        @endif

        @if($comision)
          <div class="gobi-project-sidebar__section">
            <h2 class="gobi-project-sidebar__title">Comisión</h2>
            <div class="gobi-project-sidebar__content">{{ $comision }}</div>
          </div>
        @endif

        @if($organoPresentador)
          <div class="gobi-project-sidebar__section">
            <h2 class="gobi-project-sidebar__title">Presentado por</h2>
            <div class="gobi-project-sidebar__content">{{ $organoPresentador }}</div>
          </div>
        @endif

        @if($temas && ! is_wp_error($temas))
          <div class="gobi-project-sidebar__section">
            <h2 class="gobi-project-sidebar__title">Temas</h2>
            <div class="gobi-project-sidebar__content">
              @foreach($temas as $tema)
                <span class="gobi-badge">{{ $tema->name }}</span>
              @endforeach
            </div>
          </div>
        @endif
      </aside>
    </div>
  </section>
</article>
