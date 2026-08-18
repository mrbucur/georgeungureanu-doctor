# QA — programare online cu plată

## Înainte de test

- [ ] Google Calendar conectat și calendarul corect selectat pentru conflicte.
- [ ] Google Meet conectat și setat ca locație a evenimentului.
- [ ] Stripe verificat pe entitatea care încasează.
- [ ] Tarif și monedă aprobate.
- [ ] Politica de anulare/reprogramare/rambursare aprobată.
- [ ] Politica de confidențialitate actualizată și revizuită.

## Rezervare reușită

- [ ] Intervalul este disponibil numai marți/joi, 18:00–20:00.
- [ ] Nu se poate rezerva cu mai puțin de 24 h înainte.
- [ ] Nu se poate rezerva la mai mult de 60 zile în avans.
- [ ] Plata reușită confirmă rezervarea o singură dată.
- [ ] Pacientul și George primesc emailurile corecte.
- [ ] Evenimentul apare în Google Calendar fără suprapuneri.
- [ ] Linkul Google Meet este prezent și funcțional.
- [ ] Fusul orar este afișat corect pentru pacient și pentru George.

## Situații negative

- [ ] Plata refuzată nu produce o rezervare confirmată.
- [ ] Plata abandonată eliberează intervalul într-un timp rezonabil.
- [ ] Refresh/back nu produce două plăți sau două rezervări.
- [ ] Un pacient nu poate avea mai mult de o rezervare activă.
- [ ] Reprogramarea este blocată în interiorul termenului aprobat.
- [ ] Anularea aplică politica de rambursare aprobată.
- [ ] Rambursarea integrală și cea refuzată sunt documentate corect.
- [ ] Niciun RMN/CT nu este solicitat prin email obișnuit.

## Site

- [ ] Tariful din site este identic cu tariful Cal.com/Stripe.
- [ ] CTA-ul deschide evenimentul corect.
- [ ] Termenii sunt vizibili înainte de plată.
- [ ] Fluxul trece QA pe desktop și mobil.
