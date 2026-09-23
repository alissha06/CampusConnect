<?php
include '../includes/header.php';
include '../includes/navbar.php';

// ===== Document content data =====
$documents = [
  'anti-ragging' => [
    'title' => 'Anti-Ragging Undertaking',
    'category' => 'Mandatory Compliance',
    'subtitle' => 'Mandatory statutory compliance declaration ensuring campus safety and zero-tolerance regulatory adherence.',
    'what' => 'The Anti-Ragging Undertaking is a formal affidavit mandated by the University Grants Commission (UGC). It certifies that the enrolled student and their parent/guardian have read, understood, and agreed to abide by institutional regulations prohibiting any form of ragging on or off campus.',
    'why' => 'Compliance with this undertaking is a legal and statutory prerequisite under Supreme Court of India and UGC guidelines, meant to guarantee a safe and supportive environment for all students. Submitting this undertaking is required prior to enrollment confirmation.',
    'how' => 'Prospective students complete the undertaking registration on the UGC National Anti-Ragging portal (antiragging.in), or through the institutional proforma available at the admissions desk. Upon completion, a reference registration number and printable acknowledgement are generated.',
    'steps' => [
      ['title' => 'Visit the National Anti-Ragging Portal', 'desc' => 'Access antiragging.in and select the "Undertaking Registration" option for university-affiliated colleges.'],
      ['title' => 'Fill Student and Institutional Details', 'desc' => 'Enter your basic profile, admission application reference, and institute details (Symbiosis Institute of Computer Studies and Research, Pune).'],
      ['title' => 'Verify and Submit Declaration', 'desc' => 'Review the student code of conduct terms alongside your parent or guardian. Confirm emergency contact and residential address details before submission.'],
      ['title' => 'Download and Submit Signed Acknowledgement', 'desc' => 'Save the generated PDF with your reference registration ID. Both student and parent must sign it, then submit the scanned copy as instructed by the admissions office.'],
    ],
    'resources' => ['pdf', 'guide', 'tutorial'],
  ],
  'affidavit' => [
    'title' => 'Affidavit',
    'category' => 'Legal Attestation',
    'subtitle' => 'Notarized legal declaration verifying educational continuity, authenticity of credentials, and student code of conduct.',
    'what' => 'The affidavit is a notarized legal document declaring the accuracy of your submitted academic and personal information, along with your agreement to abide by the institution\'s code of conduct.',
    'why' => 'This affidavit legally protects both the student and institution by formally verifying the authenticity of submitted credentials and confirming acceptance of institutional policies.',
    'how' => 'The affidavit format is typically provided by the admissions office and must be executed on stamp paper, notarized by a notary public or executive magistrate.',
    'steps' => [
      ['title' => 'Obtain the Affidavit Format', 'desc' => 'Download the required affidavit format from the admissions office or Notices section.'],
      ['title' => 'Print on Stamp Paper', 'desc' => 'Print the affidavit content on the appropriate denomination of non-judicial stamp paper as instructed.'],
      ['title' => 'Notarize the Document', 'desc' => 'Visit a notary public or executive magistrate to have the affidavit legally notarized.'],
      ['title' => 'Submit to Admissions Office', 'desc' => 'Submit the original notarized affidavit along with your other admission documents.'],
    ],
    'resources' => ['pdf', 'guide', 'tutorial'],
  ],
  'academic' => [
    'title' => 'Academic Documents',
    'category' => 'Academic Dossier',
    'subtitle' => 'Certified mark sheets, passing certificates, entrance exam scorecards, and migration/transfer documents.',
    'what' => 'Academic documents include your certified mark sheets, passing certificates, entrance examination scorecards, and migration/transfer certificates from your previous institution.',
    'why' => 'These documents verify your academic eligibility and prior qualifications, which are required to confirm your admission to the program.',
    'how' => 'Collect original and photocopies of all required academic documents from your previous school/college, and get photocopies self-attested where required.',
    'steps' => [
      ['title' => 'Gather Original Mark Sheets', 'desc' => 'Collect original mark sheets and passing certificates for all required academic years.'],
      ['title' => 'Obtain Entrance Score Card', 'desc' => 'Print or download your entrance examination scorecard, if applicable to your program.'],
      ['title' => 'Request Migration/Transfer Certificate', 'desc' => 'Request this from your previous institution if you are transferring from a different board or university.'],
      ['title' => 'Prepare Self-Attested Copies', 'desc' => 'Make photocopies and self-attest them as instructed by the admissions office.'],
    ],
    'resources' => ['pdf'],
  ],
  'identity' => [
    'title' => 'Identity Documents',
    'category' => 'Identity & Residence',
    'subtitle' => 'Government-authorized photo identification and permanent residence proof.',
    'what' => 'Identity documents are government-issued proofs of your identity (such as Aadhaar or Passport) along with proof of your permanent residential address.',
    'why' => 'These documents are required for identity verification during enrollment and for institutional records as per regulatory requirements.',
    'how' => 'Use any valid government-issued photo ID and a residence proof document (such as Aadhaar, utility bill, or ration card) as accepted by the admissions office.',
    'steps' => [
      ['title' => 'Prepare Photo ID Proof', 'desc' => 'Keep a valid Aadhaar card, Passport, or other accepted government photo ID ready.'],
      ['title' => 'Prepare Residence Proof', 'desc' => 'Arrange a valid residential address proof document.'],
      ['title' => 'Make Photocopies', 'desc' => 'Prepare clear photocopies of both documents for submission.'],
      ['title' => 'Carry Originals for Verification', 'desc' => 'Bring original documents along for in-person verification at the time of submission.'],
    ],
    'resources' => ['pdf'],
  ],
];

// Get the requested document, default to anti-ragging if none/invalid specified
$docKey = isset($_GET['doc']) && isset($documents[$_GET['doc']]) ? $_GET['doc'] : 'anti-ragging';
$doc = $documents[$docKey];
?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <a href="index.php">Admissions</a> / <span><?php echo $doc['title']; ?></span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Required Document &nbsp;|&nbsp; <?php echo $doc['category']; ?></p>
    <h1><?php echo $doc['title']; ?></h1>
    <p class="tagline"><?php echo $doc['subtitle']; ?></p>
  </div>
</section>

<!-- WHAT / WHY / HOW -->
<section class="about-block">
  <div class="container">
    <div class="card-grid three">
      <div class="essential-card">
        <h3>What is this?</h3>
        <p><?php echo $doc['what']; ?></p>
      </div>
      <div class="essential-card">
        <h3>Why is it required?</h3>
        <p><?php echo $doc['why']; ?></p>
      </div>
      <div class="essential-card">
        <h3>How to obtain it?</h3>
        <p><?php echo $doc['how']; ?></p>
      </div>
    </div>
  </div>
</section>

<!-- STEP BY STEP -->
<section class="about-block alt">
  <div class="container">
    <h2>Step-by-Step Instructions</h2>
    <div class="instruction-list">
      <?php foreach ($doc['steps'] as $index => $step): ?>
      <div class="instruction-item">
        <span class="instruction-number"><?php echo $index + 1; ?></span>
        <div>
          <h3><?php echo $step['title']; ?></h3>
          <p><?php echo $step['desc']; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- RESOURCES -->
<section class="about-block">
  <div class="container">
    <h2>Document Downloads &amp; Guidance</h2>
    <div class="resource-links">
  <?php if (in_array('pdf', $doc['resources'])): ?>
    <a href="#" class="resource-btn">📄 View PDF Instructions</a>
  <?php endif; ?>
  <?php if (in_array('guide', $doc['resources'])): ?>
    <a href="#" class="resource-btn">⬇ Download Guide</a>
  <?php endif; ?>
  <?php if (in_array('tutorial', $doc['resources'])): ?>
    <a href="#" class="resource-btn">▶ Watch Tutorial</a>
  <?php endif; ?>
    </div>
  </div>
</section>

<!-- BACK LINK -->
<section class="about-block alt">
  <div class="container">
    <a href="index.php" class="back-link">&larr; Back to Admissions Guidance</a>
  </div>
</section>

<?php include '../includes/footer.php'; ?>