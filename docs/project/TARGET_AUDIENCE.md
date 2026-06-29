# Target Audience

## georgeungureanu.doctor

---

## Audience Priority Order

1. **Patients** — primary audience, all decisions serve this group first
2. **Families and caregivers** — co-primary, nearly identical needs to patients
3. **Referring physicians** — secondary, needs served without compromising the primary experience
4. **Medical peers and academics** — tertiary, addressed via publications and credentials

---

## Persona 1 — The Patient Seeking Answers

**Name:** The Night-Search Patient
**Who:** A person who has recently received a concerning diagnosis or referral and is researching online

**Emotional state:**
- Anxious, often frightened
- Overwhelmed by information volume and complexity
- Uncertain about what their condition means for their life
- Unsure whether their situation is serious or manageable
- Looking for a doctor they can trust before committing to an appointment

**Information needs:**
- What is this condition, in plain language?
- How serious is it?
- What are the treatment options?
- What does recovery look like?
- Who is this doctor and can I trust them?
- Is this doctor accessible to me — do they consult in a city near me?
- How do I make an appointment, and at which location?

**What this person fears:**
- Being treated as a case number, not a person
- Being overwhelmed by information they cannot understand
- Not knowing what to do next
- Choosing the wrong doctor
- Travelling far only to discover the location or schedule does not work for them

**What this website must give them:**
- Calm, clear, jargon-free condition information
- A sense that the doctor sees them as a person
- Clear, upfront geographic information — cities, clinics, types of visit per location
- A simple, visible path to making an appointment at the right location
- Enough information to feel informed before arriving

**Design implications:**
- Large, readable body text
- Short paragraphs, no walls of text
- Section headings that answer questions ("What to Expect" not "Procedural Overview")
- Primary CTA ("Programează o consultație") on every significant page — routes to `/programari`
- Location directory (`/programari`) must be navigable from the header and from all primary CTAs
- No visual noise or competing attention demands

---

## Persona 2 — The Family Member or Caregiver

**Name:** The Concerned Family Member
**Who:** A spouse, parent, child, or close friend of a patient who is researching on their behalf

**Emotional state:**
- Protective and worried
- Often researching late at night after the patient has gone to bed
- Processing their own fear alongside trying to be strong for the patient
- May be managing logistics (appointments, transport, insurance) in addition to emotional support

**Information needs:**
- Is this the right doctor for my loved one?
- What exactly is this condition?
- What will the procedure involve?
- What does recovery look like and what help will they need?
- How do I make an appointment or get a referral?

**What this website must give them:**
- The same clarity and calm as for the patient
- Enough clinical credibility to feel confident recommending this doctor
- Practical information about the appointment and preparation process
- A sense that the doctor will treat their loved one with care

**Design implications:**
- Same as Patient persona — they share nearly all needs
- Biography section must convey warmth and approachability, not just credentials

---

## Persona 3 — The Referred Patient

**Name:** The Confirmed Appointment Patient
**Who:** A patient who has already been referred or has already booked an appointment and is now preparing

**Emotional state:**
- Still anxious but beginning to accept the situation
- Actively preparing — gathering questions, understanding what to bring, understanding what to expect
- Moving from "should I trust this doctor?" to "what do I need to know before I arrive?"

**Information needs:**
- Where exactly do I go for my appointment — which clinic, which address?
- What should I bring to my appointment?
- What happens during the consultation?
- What questions should I ask?
- What does the procedure involve?
- What does recovery look like in practical terms?
- How long will I be off work / away from home?

**What this website must give them:**
- A dedicated patient preparation section
- Pre-appointment FAQ
- Honest, plain-language procedure descriptions
- Recovery timeline information
- The `/programari` page as the definitive "where to go" resource before any appointment

**Design implications:**
- Easy navigation to patient information section from all pages
- FAQ must be comprehensive, searchable, and easy to scan
- `/programari` must be linked from the confirmation communication (out of website scope) and findable from the main navigation

---

## Persona 4 — The Referring Physician

**Name:** The Referring Doctor
**Who:** A general practitioner, neurologist, or other specialist considering referring a patient to Dr. Ungureanu

**Emotional state:**
- Professional, evaluative
- Looking for subspecialty expertise that matches the patient's needs
- Wants quick confirmation of credentials and specialization
- May share the website link with the patient as part of the referral

**Information needs:**
- What conditions does Dr. Ungureanu specialize in?
- What are his credentials and institutional affiliations?
- What is his publication record?
- How do I refer a patient?
- What is the referral and appointment process?

**What this website must give them:**
- Clear subspecialty listing
- Academic credentials and publication section
- Professional contact / referral pathway
- Enough clinical authority to justify the referral with confidence

**Design implications:**
- A dedicated "For Medical Professionals" section or a clear credentials area
- Publications page or section that lists academic work
- The overall design quality must signal professional seriousness without undermining patient warmth

---

## What All Audiences Share

Regardless of persona, every visitor to this website needs:

1. **Trust** — they need to believe this doctor is competent and cares
2. **Clarity** — they need to understand what they are reading without a medical degree
3. **Direction** — they need to know what to do next at every point in their visit
4. **Geographic orientation** — they need to know whether this doctor is accessible to them before they can commit to taking any action
5. **Speed** — they need to find what they're looking for without friction
6. **Reassurance** — they need to leave feeling better, not worse, than when they arrived

**Note on geographic orientation:** This is the most underappreciated barrier in Romanian medical websites. A patient in Baia Mare who cannot immediately see that this doctor also consults there will assume the doctor is only accessible from Cluj-Napoca and may not pursue an appointment. The `/programari` page and `molecule-location-card` exist specifically to eliminate this barrier.

---

## Audiences This Website Does NOT Serve

- Medical researchers seeking data
- General public with no personal medical context
- Press or media
- Insurance companies
- Hospital administrators

These groups may visit, but the website is not optimized for them. Their needs are not the design constraint.
