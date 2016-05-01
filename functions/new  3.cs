   private void linkLabel1_LinkClicked(object sender, LinkLabelLinkClickedEventArgs e)
        {
            System.Diagnostics.Process.Start("http://www.omu.edu.tr/"); 
        }

        private void frmAna_Load(object sender, EventArgs e)
        {
            tsbilgi.Text = "KULLANICI ADINIZ :   " + frmGiris._kadi + " ------------------  " + " SEVİYENİZ :  " + frmGiris._seviye; 
        }

        private void çıkışToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void girişFormuToolStripMenuItem_Click(object sender, EventArgs e)
        {
            frmGiris frmgiris = new frmGiris();
            frmgiris.Show();
            this.Close();
        }
    }
}
